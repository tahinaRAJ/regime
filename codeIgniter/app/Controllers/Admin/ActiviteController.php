<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ActiviteModel;

class ActiviteController extends BaseController
{
    protected $activiteModel;

    public function __construct()
    {
        $this->activiteModel = new ActiviteModel();
    }

    public function index()
    {
        $activites = $this->activiteModel->getActivites();
        return view('admin/activite/index', ['activites' => $activites]);
    }

    public function create()
    {
        return view('admin/activite/create');
    }

    public function store()
    {
        $nom = trim($this->request->getPost('nom'));
        $poids = $this->request->getPost('poidsInfluenceActivite');

        if ($nom === '' || $poids === '') {
            return redirect()->back()->with('erreur', 'Veuillez remplir tous les champs')->withInput();
        }

        $this->activiteModel->createActivite($nom, (float) $poids);

        return redirect()->to('/admin/activite')->with('success', 'Activit\u00e9 créée');
    }

    public function edit($id)
    {
        $activite = $this->activiteModel->getActiviteById((int) $id);
        if (!$activite) {
            return redirect()->to('/admin/activite')->with('erreur', 'Activit\u00e9 non trouv\u00e9e');
        }
        return view('admin/activite/edit', ['activite' => $activite]);
    }

    public function update($id)
    {
        $nom = trim($this->request->getPost('nom'));
        $poids = $this->request->getPost('poidsInfluenceActivite');

        if ($nom === '' || $poids === '') {
            return redirect()->back()->with('erreur', 'Veuillez remplir tous les champs')->withInput();
        }

        $this->activiteModel->updateActivite((int) $id, $nom, (float) $poids);

        return redirect()->to('/admin/activite')->with('success', 'Activit\u00e9 mise \u00e0 jour');
    }

    public function delete($id)
    {
        $this->activiteModel->deleteActivite((int) $id);
        return redirect()->to('/admin/activite')->with('success', 'Activit\u00e9 supprim\u00e9e');
    }
}
