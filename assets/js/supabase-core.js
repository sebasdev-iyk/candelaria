/**
 * Supabase Core Module - Candelaria 2026
 * 
 * Centralized Supabase client with cookie-based token persistence.
 * This module is designed to work across /candelaria and /php-admin.
 * 
 * @version 2.0.0
 */

(function (window) {
    'use strict';

    // ==========================================
    // CONFIGURATION
    // ==========================================
    const SUPABASE_URL = 'https://lwreqclamvezlpfryjaz.supabase.co';
    const SUPABASE_ANON_KEY = 'sb_publishable_kfUeXOlkfU8kHP8AHBkATw_LoWC3cwZ';
    const COOKIE_NAME = 'sb-access-token';
    const COOKIE_REFRESH_NAME = 'sb-refresh-token';
    const COOKIE_PATH = '/';
    const COOKIE_MAX_AGE = 60 * 60 * 24 * 7; // 7 days

    // ==========================================
    // COOKIE HELPERS
    // ==========================================
    function setCookie(name, value, maxAge = COOKIE_MAX_AGE) {
        const secure = window.location.protocol === 'https:' ? '; Secure' : '';
        document.cookie = `${name}=${encodeURIComponent(value)}; path=${COOKIE_PATH}; max-age=${maxAge}; SameSite=Lax${secure}`;
    }

    function getCookie(name) {
        const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? decodeURIComponent(match[2]) : null;
    }

    function deleteCookie(name) {
        document.cookie = `${name}=; path=${COOKIE_PATH}; max-age=0`;
    }

    // ==========================================
    // SUPABASE CLIENT INITIALIZATION
    // ==========================================
    let supabaseClient = null;
    let currentUser = null;

    function initSupabase() {
        if (typeof supabase === 'undefined') {
            console.error('[Supabase Core] SDK not loaded. Include the CDN script first.');
            return null;
        }

        if (supabaseClient) {
            return supabaseClient;
        }

        const { createClient } = supabase;

        supabaseClient = createClient(SUPABASE_URL, SUPABASE_ANON_KEY, {
            auth: {
                persistSession: true,
                autoRefreshToken: true,
                detectSessionInUrl: true
            }
        });

        // Listen for auth state changes
        supabaseClient.auth.onAuthStateChange((event, session) => {
            console.log('[Supabase Core] Auth event:', event);

            if (session) {
                // Save tokens to cookies for PHP access
                setCookie(COOKIE_NAME, session.access_token);
                if (session.refresh_token) {
                    setCookie(COOKIE_REFRESH_NAME, session.refresh_token);
                }
                currentUser = session.user;

                // Dispatch custom event for UI updates
                window.dispatchEvent(new CustomEvent('supabase-auth-change', {
                    detail: { event, user: session.user }
                }));
            } else if (event === 'SIGNED_OUT') {
                deleteCookie(COOKIE_NAME);
                deleteCookie(COOKIE_REFRESH_NAME);
                currentUser = null;

                window.dispatchEvent(new CustomEvent('supabase-auth-change', {
                    detail: { event, user: null }
                }));
            }
        });

        return supabaseClient;
    }

    // ==========================================
    // AUTH FUNCTIONS
    // ==========================================

    /**
     * Sign in with Google OAuth
     * @param {string} redirectTo - URL to redirect after auth (defaults to current page)
     */
    async function signInWithGoogle(redirectTo = null) {
        const client = initSupabase();
        if (!client) return { error: new Error('Supabase not initialized') };

        const { data, error } = await client.auth.signInWithOAuth({
            provider: 'google',
            options: {
                redirectTo: redirectTo || window.location.href.split('?')[0]
            }
        });

        return { data, error };
    }

    /**
     * Sign out current user
     */
    /**
     * Sign in with Facebook OAuth
     * @param {string} redirectTo - URL to redirect after auth (defaults to current page)
     */
    async function signInWithFacebook(redirectTo = null) {
        const client = initSupabase();
        if (!client) return { error: new Error('Supabase not initialized') };

        const { data, error } = await client.auth.signInWithOAuth({
            provider: 'facebook',
            options: {
                redirectTo: redirectTo || window.location.href.split('?')[0]
            }
        });

        return { data, error };
    }


    /**
     * Sign up with Email and Password
     */
    async function signUpWithEmail(email, password, userData = {}) {
        const client = initSupabase();
        if (!client) return { error: new Error('Supabase not initialized') };

        const { data, error } = await client.auth.signUp({
            email,
            password,
            options: {
                data: userData // e.g. { full_name: 'John Doe' }
            }
        });

        return { data, error };
    }

    /**
     * Sign in with Email and Password
     */
    async function signInWithEmail(email, password) {
        const client = initSupabase();
        if (!client) return { error: new Error('Supabase not initialized') };

        const { data, error } = await client.auth.signInWithPassword({
            email,
            password
        });

        return { data, error };
    }

    /**
     * Send password reset email
     */
    async function resetPasswordForEmail(email, redirectTo = null) {
        const client = initSupabase();
        if (!client) return { error: new Error('Supabase not initialized') };

        const { data, error } = await client.auth.resetPasswordForEmail(email, {
            redirectTo: redirectTo || window.location.href.split('?')[0]
        });

        return { data, error };
    }

    async function signOut() {
        const client = initSupabase();
        if (!client) return { error: new Error('Supabase not initialized') };

        const { error } = await client.auth.signOut();

        if (!error) {
            deleteCookie(COOKIE_NAME);
            deleteCookie(COOKIE_REFRESH_NAME);
            currentUser = null;
        }

        return { error };
    }

    /**
     * Get current authenticated user
     * @returns {Promise<{user: object|null, error: Error|null}>}
     */
    async function getCurrentUser() {
        const client = initSupabase();
        if (!client) return { user: null, error: new Error('Supabase not initialized') };

        // First check cached user
        if (currentUser) {
            return { user: currentUser, error: null };
        }

        // Otherwise fetch from Supabase
        const { data: { user }, error } = await client.auth.getUser();

        if (user) {
            currentUser = user;
        }

        return { user, error };
    }

    /**
     * Get current session
     * @returns {Promise<{session: object|null, error: Error|null}>}
     */
    async function getSession() {
        const client = initSupabase();
        if (!client) return { session: null, error: new Error('Supabase not initialized') };

        const { data: { session }, error } = await client.auth.getSession();
        return { session, error };
    }

    /**
     * Get access token from cookie (for PHP interop)
     * @returns {string|null}
     */
    function getAccessToken() {
        return getCookie(COOKIE_NAME);
    }

    /**
     * Check if user is authenticated (synchronous check via cookie)
     * @returns {boolean}
     */
    function isAuthenticated() {
        return !!getCookie(COOKIE_NAME);
    }

    // ==========================================
    // REALTIME HELPERS
    // ==========================================

    /**
     * Subscribe to a Supabase Realtime channel
     * @param {string} channelName - Name of the channel
     * @param {string} table - Table to listen to
     * @param {function} callback - Callback for new records
     * @returns {object} - Channel subscription
     */
    function subscribeToTable(channelName, table, callback, filter = null) {
        const client = initSupabase();
        if (!client) return null;

        const channelConfig = {
            event: 'INSERT',
            schema: 'public',
            table: table
        };

        if (filter) {
            channelConfig.filter = filter;
        }

        const channel = client
            .channel(channelName)
            .on('postgres_changes', channelConfig, (payload) => {
                callback(payload.new);
            })
            .subscribe((status) => {
                console.log(`[Supabase Core] Channel ${channelName} status:`, status);
            });

        return channel;
    }

    /**
     * Unsubscribe from a channel
     * @param {object} channel - Channel object from subscribeToTable
     */
    function unsubscribe(channel) {
        const client = initSupabase();
        if (client && channel) {
            client.removeChannel(channel);
        }
    }

    // ==========================================
    // DATABASE HELPERS
    // ==========================================

    /**
     * Insert a record into a table
     * @param {string} table - Table name
     * @param {object} data - Data to insert
     * @returns {Promise<{data: object|null, error: Error|null}>}
     */
    async function insert(table, data) {
        const client = initSupabase();
        if (!client) return { data: null, error: new Error('Supabase not initialized') };

        const { data: result, error } = await client
            .from(table)
            .insert(data)
            .select();

        return { data: result, error };
    }

    /**
     * Select records from a table
     * @param {string} table - Table name
     * @param {object} options - Query options (columns, filter, order, limit)
     * @returns {Promise<{data: array|null, error: Error|null}>}
     */
    async function select(table, options = {}) {
        const client = initSupabase();
        if (!client) return { data: null, error: new Error('Supabase not initialized') };

        let query = client.from(table).select(options.columns || '*');

        if (options.filter) {
            for (const [column, value] of Object.entries(options.filter)) {
                query = query.eq(column, value);
            }
        }

        if (options.order) {
            query = query.order(options.order.column, { ascending: options.order.ascending ?? false });
        }

        if (options.limit) {
            query = query.limit(options.limit);
        }

        const { data, error } = await query;
        return { data, error };
    }

    /**
     * Register a callback for auth state changes
     * @param {function} callback - Callback function(event, session)
     * @returns {object} - Subscription object
     */
    function onAuthStateChange(callback) {
        const client = initSupabase();
        if (!client) return null;

        return client.auth.onAuthStateChange((event, session) => {
            callback(event, session);
        });
    }

    // ==========================================
    // EXPORT TO GLOBAL SCOPE
    // ==========================================
    window.SupabaseCore = {
        // Config
        SUPABASE_URL,

        // Client
        init: initSupabase,
        getClient: () => supabaseClient,

        // Auth
        signInWithGoogle,
        signInWithFacebook,
        signUpWithEmail,
        signInWithEmail,
        resetPasswordForEmail,
        signOut,
        getCurrentUser,
        getSession,
        getAccessToken,
        isAuthenticated,
        onAuthStateChange,

        // Realtime
        subscribeToTable,
        unsubscribe,

        // Database
        insert,
        select
    };

    // Auto-initialize on load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSupabase);
    } else {
        initSupabase();
    }

    console.log('[Supabase Core] Module loaded. Use window.SupabaseCore to access.');

})(window);
