<?php

namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\ObjectifModel;
use App\Models\CaracteristiqueModel;

class RegimeController extends BaseController
{
    public function showIMCform()
    {
        return redirect()->to('/regime/imc');
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
        $Idoption = $this->request->getVar('Idoption');

        if ($Idoption !== null && intval($Idoption) >= 3) {
            return $this->showIMCform();
        }

        $regimes = $model->getRecommendationRegime(intval($Idoption));
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($regimes);
        }

        return view('regime/list', ['regimes' => $regimes]);
    }

    public function index()
    {
        return view('regime/index');
    }

    public function showIMCPage()
    {
        try {
            $userId = session()->get('user_id');
            $imcActuel = null;
            if ($userId) {
                $caracteristiqueModel = new CaracteristiqueModel();
                $caracteristique = $caracteristiqueModel->getCaracteristiqueByUserId($userId);
                if ($caracteristique && isset($caracteristique['weight']) && isset($caracteristique['height'])) {
                    $weight = (float) $caracteristique['weight'];
                    $height = ((float) $caracteristique['height']) / 100;
                    $regimeModel = new RegimeModel();
                    $imcActuel = $regimeModel->calculIMC($weight, $height);
                }
            }
            return view('regime/imc', ['imc_actuel' => $imcActuel]);
        } catch (\Throwable $e) {
            log_message('error', 'showIMCPage: ' . $e->getMessage());
            return view('regime/imc', ['imc_actuel' => null]);
        }
    }

    public function getRecommendationsAjax()
    {
        $imcIdeal = $this->request->getGet('imc_ideal');
        if (!$imcIdeal) {
            return $this->response->setJSON([]);
        }
        $model = new RegimeModel();
        $userId = session()->get('user_id');
        if (!$userId) {
            log_message('warning', 'getRecommendationsAjax: no user in session');
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Utilisateur non connecté']);
        }

        $caracteristiqueModel = new CaracteristiqueModel();
        $caracteristique = $caracteristiqueModel->getCaracteristiqueByUserId((int) $userId);
        if (!$caracteristique) {
            return $this->response->setJSON([]);
        }
        $weight = (float) $caracteristique['weight'];
        $height = ((float) $caracteristique['height']) / 100;
        $imcActuel = $model->calculIMC($weight, $height);

        $regimes = $model->getRegimesPourObjectifImc($imcActuel, (float)$imcIdeal, $height);
        return $this->response->setJSON($regimes);
    }

    public function getObjectifs()
    {
        try {
            $model = new ObjectifModel();
            $objectifs = $model->getObjectifs();
            return $this->response->setJSON($objectifs);
        } catch (\Throwable $e) {
            log_message('error', 'getObjectifs failed: ' . $e->getMessage());
            return $this->response->setJSON([]);
        }
    }
}
