<?php

require_once __DIR__ . '/Conexion.php';
require_once __DIR__ . '/../negocio/Ticket.php';

class TicketRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::getConnection();
    }

    public function guardar(Ticket $ticket): int
    {
        $sql = "INSERT INTO ticket (titulo, descripcion, estado) VALUES (:titulo, :descripcion, :estado)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':titulo'      => $ticket->getTitulo(),
            ':descripcion' => $ticket->getDescripcion(),
            ':estado'      => $ticket->getEstado(),
        ]);

        return (int) $this->pdo->lastInsertId();
    }
}
