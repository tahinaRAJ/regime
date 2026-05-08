<?php

namespace App\Models;

use CodeIgniter\Model;

class ActiviteModel extends Model
{
    protected $table = 'activite';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'nom',
        'poidsInfluenceActivite'
    ];

    public function getActivites()
    {
        return $this->findAll();
    }

    public function getActiviteById(int $id)
    {
        return $this->find($id);
    }

    public function createActivite(string $nom, float $poidsInfluenceActivite)
    {
        $data = [
            'nom' => $nom,
            'poidsInfluenceActivite' => $poidsInfluenceActivite
        ];

        return $this->insert($data);
    }

    public function updateActivite(int $id, string $nom, float $poidsInfluenceActivite)
    {
        $data = [
            'nom' => $nom,
            'poidsInfluenceActivite' => $poidsInfluenceActivite
        ];

        return $this->update($id, $data);
    }

    public function deleteActivite(int $id)
    {
        return $this->delete($id);
    }

    
}

