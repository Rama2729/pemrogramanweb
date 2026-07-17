-- ===========================================
-- DATABASE : SECURELOCK
-- Sistem Keamanan Brankas Berbasis OTP
-- ===========================================

CREATE DATABASE IF NOT EXISTS securelock;
USE securelock;

-- ===========================================
-- TABLE USERS
-- ===========================================

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('Admin','User') DEFAULT 'User',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===========================================
-- TABLE DEVICES
-- ===========================================

CREATE TABLE devices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    device_name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    status ENUM('Active','Inactive') DEFAULT 'Active'
);

-- ===========================================
-- TABLE OTP SETTINGS
-- ===========================================

CREATE TABLE otp_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    otp_interval INT NOT NULL DEFAULT 30,
    max_attempt INT NOT NULL DEFAULT 3,
    lock_duration INT NOT NULL DEFAULT 60
);

-- ===========================================
-- TABLE OTP LOGS
-- ===========================================

CREATE TABLE otp_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    otp_code VARCHAR(6) NOT NULL,
    generated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    expired_at DATETIME,
    status ENUM('Valid','Expired','Used') DEFAULT 'Valid',

    CONSTRAINT fk_otp_user
    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE
);

-- ===========================================
-- TABLE ACCESS LOGS
-- ===========================================

CREATE TABLE access_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    device_id INT NOT NULL,

    access_time DATETIME DEFAULT CURRENT_TIMESTAMP,

    status ENUM('Success','Failed') DEFAULT 'Failed',

    ip_address VARCHAR(100),

    CONSTRAINT fk_access_user
    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

    CONSTRAINT fk_access_device
    FOREIGN KEY (device_id)
    REFERENCES devices(id)
    ON DELETE CASCADE
);

-- ===========================================
-- DEFAULT OTP SETTING
-- ===========================================

INSERT INTO otp_settings
(otp_interval,max_attempt,lock_duration)

VALUES

(30,3,60);

-- ===========================================
-- DEFAULT DEVICE
-- ===========================================

INSERT INTO devices
(device_name,location,status)

VALUES

('Brankas Utama','Ruang Server','Active'),

('Brankas Cadangan','Gudang','Active');

-- ===========================================
-- DEFAULT ADMIN
-- ===========================================

INSERT INTO users
(username,email,password,role)

VALUES

(
'admin',
'admin@securelock.com',
MD5('admin123'),
'Admin'
);

-- ===========================================
-- DEFAULT USER
-- ===========================================

INSERT INTO users
(username,email,password,role)

VALUES

(
'user',
'user@securelock.com',
MD5('user123'),
'User'
);

-- ===========================================
-- DUMMY OTP LOG
-- ===========================================

INSERT INTO otp_logs
(user_id,otp_code,expired_at,status)

VALUES

(2,'548921',DATE_ADD(NOW(),INTERVAL 30 SECOND),'Valid'),

(2,'673210',DATE_ADD(NOW(),INTERVAL 30 SECOND),'Expired');

-- ===========================================
-- DUMMY ACCESS LOG
-- ===========================================

INSERT INTO access_logs
(user_id,device_id,status,ip_address)

VALUES

(2,1,'Success','127.0.0.1'),

(2,1,'Failed','127.0.0.1');