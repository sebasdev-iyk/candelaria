-- =============================================================================
-- SUPABASE AUTH MIGRATION - All affected tables
-- Run this script to update tables for Supabase user_id (UUID)
-- =============================================================================

-- ============================================
-- 1. RESERVACIONES TABLE
-- ============================================
ALTER TABLE reservaciones 
    ADD COLUMN IF NOT EXISTS user_id VARCHAR(36) NULL COMMENT 'Supabase UUID',
    ADD COLUMN IF NOT EXISTS user_email VARCHAR(100) NULL,
    ADD COLUMN IF NOT EXISTS user_name VARCHAR(100) NULL;

-- Make cliente_id nullable (CRITICAL for Supabase auth)
ALTER TABLE reservaciones MODIFY COLUMN cliente_id INT NULL;

-- Create index on user_id for faster lookups
CREATE INDEX IF NOT EXISTS idx_reservaciones_user_id ON reservaciones(user_id);

-- ============================================
-- 2. CALIFICACIONES TABLE
-- ============================================
ALTER TABLE calificaciones 
    ADD COLUMN IF NOT EXISTS user_id VARCHAR(36) NULL COMMENT 'Supabase UUID',
    ADD COLUMN IF NOT EXISTS user_email VARCHAR(100) NULL,
    ADD COLUMN IF NOT EXISTS user_name VARCHAR(100) NULL;

-- Make cliente_id nullable (for backwards compatibility)
ALTER TABLE calificaciones MODIFY COLUMN cliente_id INT NULL;

-- Create index on user_id for faster lookups
CREATE INDEX IF NOT EXISTS idx_calificaciones_user_id ON calificaciones(user_id);

-- ============================================
-- NOTES
-- ============================================
-- The cliente_id columns are kept for backwards compatibility with existing data.
-- New records will use user_id (Supabase UUID) instead.
