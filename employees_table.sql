-- =============================================================================
--  Employee Information System — Full Database Setup
--  PC21 Advanced Web Development | Terminal Assessment 1
--  Database : eis_db
-- =============================================================================

-- -----------------------------------------------------------------------------
-- 1. Create & select database
-- -----------------------------------------------------------------------------
CREATE DATABASE IF NOT EXISTS eis_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE eis_db;

-- =============================================================================
-- 2. DROP existing tables (order matters — FK children first)
-- =============================================================================
DROP TABLE IF EXISTS password_resets;
DROP TABLE IF EXISTS user_sessions;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS employees;

-- =============================================================================
-- 3. EMPLOYEES table
-- =============================================================================
CREATE TABLE employees (
  id           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  name         VARCHAR(100)    NOT NULL,
  position     VARCHAR(100)    NOT NULL,
  department   VARCHAR(100)    NOT NULL,
  salary       DECIMAL(12, 2)  NOT NULL DEFAULT 0.00,
  created_at   DATETIME        NULL,
  updated_at   DATETIME        NULL,
  PRIMARY KEY (id),
  INDEX idx_department (department),
  INDEX idx_name       (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- 4. USERS table  (for login / register / auth)
-- =============================================================================
CREATE TABLE users (
  id              INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  first_name      VARCHAR(80)     NOT NULL,
  last_name       VARCHAR(80)     NOT NULL,
  email           VARCHAR(180)    NOT NULL,
  password_hash   VARCHAR(255)    NOT NULL,
  role            ENUM('admin','hr','staff') NOT NULL DEFAULT 'staff',
  is_active       TINYINT(1)      NOT NULL DEFAULT 1,
  remember_token  VARCHAR(100)    NULL,
  last_login_at   DATETIME        NULL,
  created_at      DATETIME        NULL,
  updated_at      DATETIME        NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX uq_email (email),
  INDEX idx_role      (role),
  INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- 5. PASSWORD_RESETS table  (forgot-password tokens)
-- =============================================================================
CREATE TABLE password_resets (
  id          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  email       VARCHAR(180)  NOT NULL,
  token       VARCHAR(100)  NOT NULL,
  expires_at  DATETIME      NOT NULL,
  used_at     DATETIME      NULL,
  created_at  DATETIME      NULL,
  PRIMARY KEY (id),
  INDEX idx_pr_email (email),
  INDEX idx_pr_token (token)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- 6. USER_SESSIONS table  (optional — persistent "remember me")
-- =============================================================================
CREATE TABLE user_sessions (
  id          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  user_id     INT UNSIGNED  NOT NULL,
  token       VARCHAR(100)  NOT NULL,
  ip_address  VARCHAR(45)   NULL,
  user_agent  VARCHAR(255)  NULL,
  expires_at  DATETIME      NOT NULL,
  created_at  DATETIME      NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX uq_token   (token),
  INDEX idx_us_user_id    (user_id),
  CONSTRAINT fk_us_user
    FOREIGN KEY (user_id) REFERENCES users (id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- 7. SEED — employees
-- =============================================================================
INSERT INTO employees (name, position, department, salary, created_at, updated_at) VALUES
  ('Maria Clara Santos',   'Senior Software Engineer', 'Information Technology', 75000.00, NOW(), NOW()),
  ('Jose Rizal Reyes',     'Finance Manager',          'Finance',                68000.00, NOW(), NOW()),
  ('Ana Bonifacio Cruz',   'HR Specialist',            'Human Resources',        45000.00, NOW(), NOW()),
  ('Pedro Aguinaldo Lim',  'Marketing Coordinator',    'Marketing',              42000.00, NOW(), NOW()),
  ('Luisa Silang Mendoza', 'Operations Supervisor',    'Operations',             55000.00, NOW(), NOW()),
  ('Carlos Mabini Torres', 'Data Analyst',             'Information Technology', 58000.00, NOW(), NOW()),
  ('Rosa Lapu-Lapu Diaz',  'Sales Representative',     'Sales',                  38000.00, NOW(), NOW()),
  ('Miguel Luna Ferrer',   'Legal Counsel',            'Legal',                  90000.00, NOW(), NOW());

-- =============================================================================
-- 8. SEED — users
--    Passwords are bcrypt hashes of the plaintext shown in the comment.
--    Generate fresh hashes in PHP:  password_hash('secret', PASSWORD_BCRYPT)
-- =============================================================================
INSERT INTO users
  (first_name, last_name, email, password_hash, role, is_active, created_at, updated_at)
VALUES
  -- password: Admin@1234
  ('System', 'Admin',
   'admin@eis.local',
   '$2y$12$eImiTXuWVxfM37uY4JANjQ==hashed_replace_me_admin',
   'admin', 1, NOW(), NOW()),

  -- password: HRUser@1234
  ('HR', 'Manager',
   'hr@eis.local',
   '$2y$12$eImiTXuWVxfM37uY4JANjQ==hashed_replace_me_hr',
   'hr', 1, NOW(), NOW()),

  -- password: Staff@1234
  ('Staff', 'User',
   'staff@eis.local',
   '$2y$12$eImiTXuWVxfM37uY4JANjQ==hashed_replace_me_staff',
   'staff', 1, NOW(), NOW());

SELECT 'employees'       AS `table`, COUNT(*) AS `rows` FROM employees
UNION ALL
SELECT 'users'           AS `table`, COUNT(*) AS `rows` FROM users
UNION ALL
SELECT 'password_resets' AS `table`, COUNT(*) AS `rows` FROM password_resets
UNION ALL
SELECT 'user_sessions'   AS `table`, COUNT(*) AS `rows` FROM user_sessions;