<?php

namespace App\Controllers;

use App\Models\OptionModel;
use App\Models\PorteMonaieModel;
use App\Models\RegimeModel;

class PaiementController extends BaseController
{
    public const GOLD_PRICE = 25000;

    public PorteMonaieModel $porteMonaieModel;
    public RegimeModel $regimeModel;
    public OptionModel $optionModel;

    public function __construct()
    {
        $this->porteMonaieModel = new PorteMonaieModel();
        $this->regimeModel = new RegimeModel();
        $this->optionModel = new OptionModel();
    }

    public function getLoggedUser(): ?array
    {
        $user = session()->get('user');

        return is_array($user) ? $user : null;
    }

    public function getGoldOptionId(): ?int
    {
        $option = $this->optionModel->where('nom', 'Gold')->first();

        return $option['id'] ?? null;
    }

    public function userHasGold(int $userId): bool
    {
        $goldOptionId = $this->getGoldOptionId();
        if (!$goldOptionId) {
            return false;
        }

        $exists = $this->db->table('userOption')
            ->where('idUser', $userId)
            ->where('idOption', $goldOptionId)
            ->get()
            ->getRowArray();

        return !empty($exists);
    }

    public function goldMultiplier(int $userId): float
    {
        return $this->userHasGold($userId) ? 0.85 : 1.0;
    }

    public function gold()
    {
        $user = $this->getLoggedUser();
        if (!$user) {
            return redirect()->to('/login');
        }

        $userId = (int) $user['id'];

        return view('paiement/gold', [
            'user' => $user,
            'isGold' => $this->userHasGold($userId),
            'goldPrice' => self::GOLD_PRICE,
            'solde' => $this->porteMonaieModel->getSolde($userId),
        ]);
    }

    public function acheterGold()
    {
        $user = $this->getLoggedUser();
        if (!$user) {
            return redirect()->to('/login');
        }

        $userId = (int) $user['id'];

        if ($this->userHasGold($userId)) {
            return redirect()->back()->with('erreur', 'Vous avez déjà l’option Gold.');
        }

        $solde = (float) $this->porteMonaieModel->getSolde($userId);
        if ($solde < self::GOLD_PRICE) {
            return redirect()->back()->with('erreur', 'Solde insuffisant pour acheter l’option Gold.');
        }

        $deducted = $this->porteMonaieModel->DeductSolde($userId, self::GOLD_PRICE);
        if ($deducted === false) {
            return redirect()->back()->with('erreur', 'Impossible de débiter le portefeuille.');
        }

        $goldOptionId = $this->getGoldOptionId();
        if (!$goldOptionId) {
            return redirect()->back()->with('erreur', 'Option Gold introuvable en base.');
        }

        $this->db->table('userOption')->insert([
            'idUser' => $userId,
            'idOption' => $goldOptionId,
        ]);

        $this->db->table('paiement')->insert([
            'idUser' => $userId,
            'datePaiement' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/paiement/gold')->with('success', 'Option Gold activée avec succès.');
    }

    public function showRegimeDetail($id)
    {
        $user = $this->getLoggedUser();
        if (!$user) {
            return redirect()->to('/login');
        }

        $regime = $this->regimeModel->getRegimeById((int) $id);
        if (!$regime) {
            return redirect()->to('/regime')->with('erreur', 'Régime introuvable.');
        }

        $userId = (int) $user['id'];
        $price = (float) $regime['prixJournalier'];
        $finalPrice = round($price * $this->goldMultiplier($userId), 2);

        return view('paiement/regime_detail', [
            'user' => $user,
            'regime' => $regime,
            'isGold' => $this->userHasGold($userId),
            'prixBase' => $price,
            'prixFinal' => $finalPrice,
            'solde' => $this->porteMonaieModel->getSolde($userId),
            'objectifId' => (int) ($this->request->getGet('objectif') ?? 0),
        ]);
    }

    public function acheterRegime($id)
    {
        $user = $this->getLoggedUser();
        if (!$user) {
            return redirect()->to('/login');
        }

        $regime = $this->regimeModel->getRegimeById((int) $id);
        if (!$regime) {
            return redirect()->to('/regime')->with('erreur', 'Régime introuvable.');
        }

        $userId = (int) $user['id'];
        $objectifId = (int) ($this->request->getPost('objectif_id') ?: $this->request->getGet('objectif') ?: 1);
        $prixBase = (float) $regime['prixJournalier'];
        $prixFinal = round($prixBase * $this->goldMultiplier($userId), 2);

        $solde = (float) $this->porteMonaieModel->getSolde($userId);
        if ($solde < $prixFinal) {
            return redirect()->back()->with('erreur', 'Solde insuffisant pour acheter ce régime.');
        }

        $deducted = $this->porteMonaieModel->DeductSolde($userId, $prixFinal);
        if ($deducted === false) {
            return redirect()->back()->with('erreur', 'Impossible de débiter le portefeuille.');
        }

        $this->db->table('choixUser')->insert([
            'idUser' => $userId,
            'idObjectif' => $objectifId,
            'idRegime' => (int) $id,
            'durée' => (int) ($regime['dureeInfluencefood'] ?? 1),
            'dateChoix' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/paiement/regime/' . (int) $id . '?objectif=' . $objectifId)
            ->with('success', 'Régime acheté avec succès.');
    }
}