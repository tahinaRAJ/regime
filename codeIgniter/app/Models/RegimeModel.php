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

    public function getRegimes()
    {
        return $this->findAll();
    }

    public function getRegimesPourPerdrePoids(float $poidsAPerdre): array
    {
        return $this->buildRegimeRecommendations(abs($poidsAPerdre), false);
    }

    public function getRegimesPourGagnerPoids(float $poidsAGagner): array
    {
        return $this->buildRegimeRecommendations(abs($poidsAGagner), true);
    }

    public function getRegimesPourObjectifImc(float $imcActuel, float $imcIdeal, float $tailleMetre): array
    {
        $poidsActuel = $imcActuel * ($tailleMetre ** 2);
        $poidsCible  = $imcIdeal * ($tailleMetre ** 2);
        $differencePoids = $poidsCible - $poidsActuel;

        if ($differencePoids > 0) {
            return $this->getRegimesPourGagnerPoids($differencePoids);
        }

        if ($differencePoids < 0) {
            return $this->getRegimesPourPerdrePoids(abs($differencePoids));
        }

        return [];
    }

    private function buildRegimeRecommendations(float $objectifPoidsKg, bool $isGain): array
    {
        if ($objectifPoidsKg <= 0) {
            return [];
        }

        $operator = $isGain ? '>' : '<';
        $regimes = $this->where('poidsInfluencefood ' . $operator, 0)->findAll();
        $recommendations = [];

        foreach ($regimes as $regime) {
            $influence = (float) $regime['poidsInfluencefood'];
            $duree = (int) ($regime['dureeInfluencefood'] ?? 0);
            $prixJournalier = (float) ($regime['prixJournalier'] ?? 0);

            if ($influence == 0.0 || $duree <= 0) {
                continue;
            }

            $cyclesNecessaires = (int) ceil($objectifPoidsKg / abs($influence));
            $joursEstimes = $cyclesNecessaires * $duree;
            $coutEstime = $joursEstimes * $prixJournalier;

            $regime['objectifKg'] = round($objectifPoidsKg, 2);
            $regime['variationParCycleKg'] = round($influence, 2);
            $regime['cyclesNecessaires'] = $cyclesNecessaires;
            $regime['joursEstimes'] = $joursEstimes;
            $regime['coutEstime'] = round($coutEstime, 2);

            $recommendations[] = $regime;
        }

        usort($recommendations, static fn ($a, $b) => $a['joursEstimes'] <=> $b['joursEstimes']);

        return $recommendations;
    }
}
