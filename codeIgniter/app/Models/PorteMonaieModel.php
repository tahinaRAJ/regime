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
}
