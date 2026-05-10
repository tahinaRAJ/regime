<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegimeModel;
use App\Models\ActiviteModel;

class RegimeAdminController extends BaseController
{
    protected $regimeModel;
    protected $activiteModel;

    public function __construct()
    {
        $this->regimeModel = new RegimeModel();
        $this->activiteModel = new ActiviteModel();
    }

    public function index()
    {
        $regimes = $this->regimeModel->getRegimes();
        return view('admin/regime/index', ['regimes' => $regimes]);
    }

    public function create()
    {
        $activites = $this->activiteModel->findAll();
        return view('admin/regime/create', ['activites' => $activites]);
    }

    public function store()
    {
        $nom = trim($this->request->getPost('nom'));
        $description = trim($this->request->getPost('description'));
        $prix = $this->request->getPost('prixJournalier');
        $poidsFood = $this->request->getPost('poidsInfluencefood');
        $dureeFood = $this->request->getPost('dureeInfluencefood');
        $idActivite = $this->request->getPost('idActivite');
        $pourcViande = $this->request->getPost('pourcentageViande') ?? 0;
        $pourcPoisson = $this->request->getPost('pourcentagePoisson') ?? 0;
        $pourcVolaille = $this->request->getPost('pourcentageVolaille') ?? 0;

        if ($nom === '' || $prix === '' || $poidsFood === '' || $dureeFood === '' || $idActivite === '') {
            return redirect()->back()->with('erreur', 'Veuillez remplir les champs requis')->withInput();
        }

        $this->regimeModel->createRegime($nom, $description, (float) $prix, (float) $poidsFood, (int) $dureeFood, (int) $idActivite, (float) $pourcViande, (float) $pourcPoisson, (float) $pourcVolaille);

        return redirect()->to('/admin/regime')->with('success', 'R\u00e9gime cr\u00e9\u00e9');
    }

    public function edit($id)
    {
        $regime = $this->regimeModel->getRegimeById((int) $id);
        if (!$regime) {
            return redirect()->to('/admin/regime')->with('erreur', 'R\u00e9gime non trouv\u00e9');
        }
        $activites = $this->activiteModel->findAll();
        return view('admin/regime/edit', ['regime' => $regime, 'activites' => $activites]);
    }

    public function update($id)
    {
        $nom = trim($this->request->getPost('nom'));
        $description = trim($this->request->getPost('description'));
        $prix = $this->request->getPost('prixJournalier');
        $poidsFood = $this->request->getPost('poidsInfluencefood');
        $dureeFood = $this->request->getPost('dureeInfluencefood');
        $idActivite = $this->request->getPost('idActivite');
        $pourcViande = $this->request->getPost('pourcentageViande') ?? 0;
        $pourcPoisson = $this->request->getPost('pourcentagePoisson') ?? 0;
        $pourcVolaille = $this->request->getPost('pourcentageVolaille') ?? 0;

        if ($nom === '' || $prix === '' || $poidsFood === '' || $dureeFood === '' || $idActivite === '') {
            return redirect()->back()->with('erreur', 'Veuillez remplir les champs requis')->withInput();
        }

        $this->regimeModel->updateRegime((int) $id, $nom, $description, (float) $prix, (float) $poidsFood, (int) $dureeFood, (int) $idActivite, (float) $pourcViande, (float) $pourcPoisson, (float) $pourcVolaille);

        return redirect()->to('/admin/regime')->with('success', 'R\u00e9gime mis \u00e0 jour');
    }

    public function delete($id)
    {
        $this->regimeModel->deleteRegime((int) $id);
        return redirect()->to('/admin/regime')->with('success', 'R\u00e9gime supprim\u00e9');
    }
}
