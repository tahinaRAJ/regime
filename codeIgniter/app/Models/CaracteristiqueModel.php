<?php

namespace App\Models;

use CodeIgniter\Model;

class CaracteristiqueModel extends Model
{
    protected $table = 'caracteristique';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'idUser',
        'age',
        'height',
        'weight'
    ];

    public function getCaracteristiqueByUserId(int $idUser)
    {
        return $this->where('idUser', $idUser)->first();
    }

    
}
