<?php

namespace App\Controllers;

use App\Models\PorteMonaieModel;

class PorteMonaieController extends BaseController
{
    protected $porteMonaieModel;

    public function __construct()
    {
        $this->porteMonaieModel = new PorteMonaieModel();
    }

    private function getLoggedUser(): ?array
    {
        $user = session()->get('user');

        return is_array($user) ? $user : null;
    }

    public function showRechargeForm()
    {
        $data = [];
        return view('portemonaie/recharge', $data);
    }

    public function rechargeByCode()
    {
        $user = $this->getLoggedUser();

        if (!$user) {
            return redirect()->to('/login');
        }

        $idUser = $user['id'] ?? null;
        $userName = $user['name'] ?? 'utilisateur';

        if (!$idUser) {
            return redirect()->to('/login');
        }

        $nomCode = $this->request->getPost('code');

        if (!$nomCode) {
            return redirect()->back()->with('erreur', 'Veuillez entrer un code.');
        }

        $code = $this->porteMonaieModel->validerCode($nomCode);

        if (!$code) {
            return redirect()->back()->with('erreur', 'Code invalide ou déjà utilisé.');
        }

        $result = $this->porteMonaieModel->addSoldeByCode($idUser, $nomCode);

        if ($result) {
            $nouveauSolde = $this->porteMonaieModel->getSolde($idUser);
            $montant = number_format($code->montant, 2, ',', ' ');
            $nouveauSoldeFormaté = number_format($nouveauSolde, 2, ',', ' ');
            
            $message = "Code rechargé de {$montant} dans le compte de {$userName}. Nouveau solde: {$nouveauSoldeFormaté}";
            return redirect()->back()->with('success', $message);
        }

        return redirect()->back()->with('erreur', 'Erreur lors du rechargement. Veuillez réessayer.');
    }

    /**
     * Retourne le solde actuel (via AJAX)
     */
    public function getSoldeAjax()
    {
        $user = $this->getLoggedUser();

        if (!$user || empty($user['id'])) {
            return $this->response->setJSON(['erreur' => 'Non authentifié'], false);
        }

        $idUser = $user['id'];

        $solde = $this->porteMonaieModel->getSolde($idUser);

        return $this->response->setJSON(['solde' => $solde], false);
    }
}
