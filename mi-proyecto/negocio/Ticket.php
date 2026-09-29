<?php


class Ticket
{
    private string $titulo;
    private string $descripcion;
    private string $estado;

 
    public function __construct(string $titulo, string $descripcion)
    {
        $this->titulo      = trim($titulo);
        $this->descripcion = trim($descripcion);
        $this->estado      = 'pendiente'; // Regla de negocio: estado inicial siempre "pendiente"
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }
}
