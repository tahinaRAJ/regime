<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class DashboardController extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $userCount = (int) $db->table('user')->countAllResults();
        $regimeCount = (int) $db->table('regime')->countAllResults();
        $activiteCount = (int) $db->table('activite')->countAllResults();
        $codeCount = (int) $db->table('code')->countAllResults();
        $goldUserCount = (int) $db->table('userOption')
            ->join('option', 'option.id = userOption.idOption')
            ->where('option.nom', 'Gold')
            ->countAllResults();
        $choiceCount = (int) $db->table('choixUser')->countAllResults();
        $paymentCount = (int) $db->table('paiement')->countAllResults();

        $totalWallet = (float) ($db->table('portemonaie')->selectSum('montant')->get()->getRowArray()['montant'] ?? 0);

        $recentChoices = $db->table('choixUser')
            ->select('choixUser.dateChoix, user.name AS userName, regime.nom AS regimeName, objectif.nom AS objectifName, choixUser.`durée` AS duree')
            ->join('user', 'user.id = choixUser.idUser')
            ->join('regime', 'regime.id = choixUser.idRegime')
            ->join('objectif', 'objectif.id = choixUser.idObjectif')
            ->orderBy('choixUser.dateChoix', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $recentTopups = $db->table('portemonaie')
            ->select('portemonaie.montant, user.name AS userName')
            ->join('user', 'user.id = portemonaie.idUser')
            ->orderBy('portemonaie.id', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $objectiveStats = $db->table('choixUser')
            ->select('objectif.nom AS label, COUNT(*) AS total')
            ->join('objectif', 'objectif.id = choixUser.idObjectif')
            ->groupBy('choixUser.idObjectif')
            ->get()
            ->getResultArray();

        return view('admin/dashboard', [
            'userCount' => $userCount,
            'regimeCount' => $regimeCount,
            'activiteCount' => $activiteCount,
            'codeCount' => $codeCount,
            'goldUserCount' => $goldUserCount,
            'choiceCount' => $choiceCount,
            'paymentCount' => $paymentCount,
            'totalWallet' => $totalWallet,
            'recentChoices' => $recentChoices,
            'recentTopups' => $recentTopups,
            'objectiveStats' => $objectiveStats,
        ]);
    }
}
