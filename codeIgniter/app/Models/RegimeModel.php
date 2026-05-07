<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table = 'regime';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'nom',
        'description',
        'prixJournalier',
        'poidsInfluence',
        'dureeInfluence',
        'pourcentageViande',
        'pourcentagePoisson',
        'pourcentageVolaille'
    ];
}
