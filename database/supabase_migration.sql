-- =============================================================================
-- SUPABASE AUTH MIGRATION - reservaciones table
-- Run this script to update the reservaciones table for Supabase user_id (UUID)
-- =============================================================================

-- Step 1: Add new columns for Supabase user data
ALTER TABLE reservaciones 
    ADD COLUMN IF NOT EXISTS user_id VARCHAR(36) NULL COMMENT 'Supabase UUID',
    ADD COLUMN IF NOT EXISTS user_email VARCHAR(100) NULL,
    ADD COLUMN IF NOT EXISTS user_name VARCHAR(100) NULL;

-- Step 2: Create index on user_id for faster lookups
CREATE INDEX IF NOT EXISTS idx_reservaciones_user_id ON reservaciones(user_id);

-- Step 3: (Optional) If you have existing reservations linked to clientes,
-- you may run a migration query here to copy data over
-- Example (only run if needed):
-- UPDATE reservaciones r 
-- JOIN clientes c ON r.cliente_id = c.id
-- SET r.user_email = c.email, r.user_name = c.nombre
-- WHERE r.user_id IS NULL;

-- Note: The cliente_id column is kept for backwards compatibility
-- but will no longer be used by the new Supabase auth system.
-- You may drop it later once migration is fully complete:
-- ALTER TABLE reservaciones DROP COLUMN cliente_id;
