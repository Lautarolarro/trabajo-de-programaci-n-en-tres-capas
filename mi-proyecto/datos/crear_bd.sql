
CREATE DATABASE IF NOT EXISTS tickets
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE tickets;

CREATE TABLE IF NOT EXISTS ticket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    estado VARCHAR(50) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO ticket (titulo, descripcion, estado) VALUES
('Ticket de ejemplo 1', 'Esta es una descripción de prueba para verificar el funcionamiento.', 'pendiente'),
('Ticket de ejemplo 2', 'Otro ticket de prueba con estado pendiente.', 'pendiente');
