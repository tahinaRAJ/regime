<?php

namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\CaracteristiqueModel;

class RegimeController extends BaseController
{
    public function showIMCform()
    {
        return view('regime/form');
    }

    public function showRegimeRecommendations()
    {
        $model = new RegimeModel();

        $userId = session()->get('user_id');
        $caracteristiqueModel = new CaracteristiqueModel();
        $caracteristique = $caracteristiqueModel->getCaracteristiqueByUserId($userId);
        $weight = $caracteristique['weight'];
        $height = $caracteristique['height'] / 100;
        $imcActuel = $model->calculIMC($weight, $height);
        $imcIdeal = $this->request->getPost('imc_ideal');

        $regimes = $model->getRegimesPourObjectifImc($imcActuel, $imcIdeal, $height);
        return view('regime/recommendations', ['regimes' => $regimes]);
    }

    public function showRegimeList()
    {
        $model = new RegimeModel();
        $Idoption = $this->request->getPost('Idoption');
        if ($Idoption >= 3) {
            $this->showIMCform();
            return;
        }
        $regimes = $model->getRecommendationRegime($Idoption);
        return view('regime/list', ['regimes' => $regimes]);
    }
}
