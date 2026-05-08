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

    public function getRecommendationRegime(int $id){
        if($id == 1){
            return $this->getRegimesPourPerdrePoids(5);
        } else if($id == 2){
            return $this->getRegimesPourGagnerPoids(5);
        } else {
            return [];
        }
    }

    private function buildRegimeRecommendations(float $objectifPoidsKg, bool $isGain): array
    {
        if ($objectifPoidsKg <= 0) {
            return [];
        }

        $operator = $isGain ? '>' : '<';
        $regimes = $this->where('poidsInfluencefood ' . $operator, 0)->findAll();
        $recommendations = [];

        $ActiviteModel = new ActiviteModel();
        foreach ($regimes as $regime) {
            $activite = $ActiviteModel->find($regime['idActivite']);
            if ($activite) {
                $regime['nomActivite'] = $activite['nom'];
                $regime['poidsInfluenceActivite'] = $activite['poidsInfluenceActivite'];
            } else {
                $regime['nomActivite'] = 'Aucune activité associée';
                $regime['poidsInfluenceActivite'] = 0.0;
            }

            $influence = (float) $regime['poidsInfluencefood'] + (float) $regime['poidsInfluenceActivite'];
            $duree = (int) ($regime['dureeInfluencefood']);
            $prixJournalier = (float) ($regime['prixJournalier']);

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

    public function createRegime(string $nom, string $description, float $prixJournalier, float $poidsInfluencefood, int $dureeInfluencefood, float $poidsInfluenceActivite, int $dureeInfluenceActivite, float $pourcentageViande, float $pourcentagePoisson, float $pourcentageVolaille)
    {
        $data = [
            'nom' => $nom,
            'description' => $description,
            'prixJournalier' => $prixJournalier,
            'poidsInfluencefood' => $poidsInfluencefood,
            'dureeInfluencefood' => $dureeInfluencefood,
            'poidsInfluenceActivite' => $poidsInfluenceActivite,
            'dureeInfluenceActivite' => $dureeInfluenceActivite,
            'pourcentageViande' => $pourcentageViande,
            'pourcentagePoisson' => $pourcentagePoisson,
            'pourcentageVolaille' => $pourcentageVolaille
        ];

        return $this->insert($data);
    }

    public function updateRegime(int $id, string $nom, string $description, float $prixJournalier, float $poidsInfluencefood, int $dureeInfluencefood, float $poidsInfluenceActivite, int $dureeInfluenceActivite, float $pourcentageViande, float $pourcentagePoisson, float $pourcentageVolaille)
    {
        $data = [
            'nom' => $nom,
            'description' => $description,
            'prixJournalier' => $prixJournalier,
            'poidsInfluencefood' => $poidsInfluencefood,
            'dureeInfluencefood' => $dureeInfluencefood,
            'poidsInfluenceActivite' => $poidsInfluenceActivite,
            'dureeInfluenceActivite' => $dureeInfluenceActivite,
            'pourcentageViande' => $pourcentageViande,
            'pourcentagePoisson' => $pourcentagePoisson,
            'pourcentageVolaille' => $pourcentageVolaille
        ];

        return $this->update($id, $data);
    }

    public function deleteRegime(int $id)
    {
        return $this->delete($id);
    }

    public function getRegimeById(int $id)
    {
        return $this->find($id);
    }

}
