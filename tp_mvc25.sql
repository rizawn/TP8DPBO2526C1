CREATE DATABASE IF NOT EXISTS `tp_mvc25` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tp_mvc25`;

DROP TABLE IF EXISTS `courses`;
DROP TABLE IF EXISTS `lecturers`;
DROP TABLE IF EXISTS `departments`;

-- Tabel departemen / program studi
CREATE TABLE `departments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(20) NOT NULL UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    `faculty` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel dosen (tabel utama yang dikembangkan dengan relasi ke departemen)
CREATE TABLE `lecturers` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(150) NOT NULL,
    `nidn` VARCHAR(30) NOT NULL UNIQUE,
    `phone` VARCHAR(25) NOT NULL,
    `join_date` DATE NOT NULL,
    `department_id` INT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_lecturers_department` FOREIGN KEY (`department_id`)
        REFERENCES `departments`(`id`)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel mata kuliah berelasi ke dosen pengampu dan departemen
CREATE TABLE `courses` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(20) NOT NULL UNIQUE,
    `name` VARCHAR(150) NOT NULL,
    `sks` INT NOT NULL,
    `semester` INT NOT NULL,
    `lecturer_id` INT NULL,
    `department_id` INT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_courses_lecturer` FOREIGN KEY (`lecturer_id`)
        REFERENCES `lecturers`(`id`)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    CONSTRAINT `fk_courses_department` FOREIGN KEY (`department_id`)
        REFERENCES `departments`(`id`)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data awal departemen
INSERT INTO `departments` (`code`, `name`, `faculty`) VALUES
('IK', 'Ilmu Komputer', 'FPMIPA'),
('SI', 'Sistem Informasi', 'FPMIPA'),
('PSTI', 'Pendidikan Sistem & Teknologi Informasi', 'FPMIPA'),
('TK', 'Teknik Komputer', 'FPMIPA');

-- Data awal dosen
INSERT INTO `lecturers` (`name`, `nidn`, `phone`, `join_date`, `department_id`) VALUES
('Dr. Rosa Ariani Sukamto, M.T.', '0012038001', '081220011223', '2010-08-01', 1),
('Dr. Enjun Junaeti, M.Si.', '0025077502', '081321456789', '2008-03-15', 1),
('Erna Piantari, S.Kom., M.T.', '0019058503', '085721889900', '2014-02-01', 2),
('Rizky Rachman Judhie Putra, M.Kom.', '0008119004', '087822334455', '2018-09-01', 3);

-- Data awal mata kuliah
INSERT INTO `courses` (`code`, `name`, `sks`, `semester`, `lecturer_id`, `department_id`) VALUES
('IK310', 'Desain dan Pemrograman Berorientasi Objek', 3, 3, 1, 1),
('IK210', 'Struktur Data dan Algoritma', 3, 3, 2, 1),
('SI201', 'Rekayasa Perangkat Lunak', 3, 4, 3, 2),
('IK105', 'Sistem Basis Data', 3, 2, 2, 1),
('TI302', 'Arsitektur dan Organisasi Komputer', 3, 3, 4, 3);
