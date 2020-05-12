<?php

namespace App\Models;

use App\Core\Model;

class Turnos extends Model
{
    protected $table = 'turnos';

    public function get()
    {
        return $this->db->selectAll($this->table);
    }

    public function getId($idTurno)
    {
        return $this->db->selectId($idTurno, $this->table);
    }

    public function insert(array $turno)
    {
        $this->db->insert($this->table, $turno);
    }

    public function update($idTurno, array $turno)
    {
        $this->db->update($this->table,$idTurno,$turno);
    }

    public function delete($idTurno)
    {
       $this->db->delete($this->table,$idTurno);
    }
}
