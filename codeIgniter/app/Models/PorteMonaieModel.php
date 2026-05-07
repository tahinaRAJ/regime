<?php

namespace App\Models;

use CodeIgniter\Model;

class PorteMonaieModel extends Model
{
    protected $table = 'portemonaie';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'idUser',
        'montant'
    ];

    public function getSolde($idUser)
    {
        $result = $this->selectSum('montant')
            ->where('idUser', $idUser)
            ->first();

        $solde = $result['montant'] ?? 0;
        return $solde;
    }

    public function DeductSolde($idUser, $montant)
    {
        $soldeActuel = $this->getSolde($idUser);
        $nouveauSolde = $soldeActuel - $montant;

        if ($nouveauSolde < 0) {
            return false;
        }

        $inserted = $this->insert([
            'idUser' => $idUser,
            'montant' => -$montant
        ]);

        if ($inserted) {
            return $nouveauSolde;
        }

        return false;
    }

    public function validerCode($nomCode)
    {
        $code = $this->db->table('code')
            ->where('nom', $nomCode)
            ->where('isValid', 1)
            ->first();

        if (!$code) {
            return null;
        }

        return $code;
    }

    public function addSoldeByCode($idUser, $nomCode)
    {
        $code = $this->validerCode($nomCode);

        if (!$code) {
            return false;
        }

        $inserted = $this->insert([
            'idUser' => $idUser,
            'montant' => $code->montant
        ]);

        if ($inserted) {
            $codeUpdated = $this->db->table('code')
                ->where('id', $code->id)
                ->update(['isValid' => 0]);

            if ($codeUpdated) {
                return true;
            }
        }

        return false;
    }
}
