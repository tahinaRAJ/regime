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
        'poidsInfluencefood',
        'dureeInfluencefood',
        'poidsInfluenceActivite',
        'dureeInfluenceActivite',
        'pourcentageViande',
        'pourcentagePoisson',
        'pourcentageVolaille'
    ];


    
}
