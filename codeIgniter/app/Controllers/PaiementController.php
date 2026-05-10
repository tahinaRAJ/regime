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
    protected $db;

    public function __construct()
    {
        $this->porteMonaieModel = new PorteMonaieModel();
        $this->regimeModel = new RegimeModel();
        $this->optionModel = new OptionModel();
        $this->db = \Config\Database::connect();
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
            'bought' => (bool) $this->db->table('choixUser')->where('idUser', $userId)->where('idRegime', (int)$id)->get()->getRow(),
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

    public function exportPdf($id)
    {
        $user = $this->getLoggedUser();
        if (!$user) {
            return redirect()->to('/login');
        }

        $userId = (int) $user['id'];

        // verify purchase
        $purchase = $this->db->table('choixUser')->where('idUser', $userId)->where('idRegime', (int)$id)->get()->getRowArray();
        if (!$purchase) {
            return redirect()->back()->with('erreur', 'Vous ne pouvez exporter que les régimes achetés.');
        }

        $regime = $this->regimeModel->getRegimeById((int) $id);
        if (!$regime) {
            return redirect()->back()->with('erreur', 'Régime introuvable.');
        }

        // ensure FPDF font path points to the repo font folder
        if (!defined('FPDF_FONTPATH')) {
            define('FPDF_FONTPATH', realpath(__DIR__ . '/../../font') . DIRECTORY_SEPARATOR);
        }

        require_once APPPATH . 'fpdf.php';

        // helper to remove accents / transliterate to ASCII
        $ascii = function ($s) {
            if (!is_string($s)) return '';
            $s = trim($s);
            if (function_exists('iconv')) {
                $out = @iconv('UTF-8', 'ASCII//TRANSLIT', $s);
                if ($out !== false) {
                    // remove any remaining non-printable/non-ascii
                    return preg_replace('/[^\x20-\x7E]/', '', $out);
                }
            }
            // fallback mapping
            $trans = array(
                'á'=>'a','à'=>'a','ä'=>'a','â'=>'a','Á'=>'A','À'=>'A','Â'=>'A','Ä'=>'A',
                'é'=>'e','è'=>'e','ë'=>'e','ê'=>'e','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E',
                'í'=>'i','ì'=>'i','ï'=>'i','î'=>'i','Í'=>'I','Ì'=>'I','Ï'=>'I','Î'=>'I',
                'ó'=>'o','ò'=>'o','ö'=>'o','ô'=>'o','Ó'=>'O','Ò'=>'O','Ô'=>'O','Ö'=>'O',
                'ú'=>'u','ù'=>'u','ü'=>'u','û'=>'u','Ú'=>'U','Ù'=>'U','Û'=>'U','Ü'=>'U',
                'ç'=>'c','Ç'=>'C','ñ'=>'n','Ñ'=>'N'
            );
            $out = strtr($s, $trans);
            return preg_replace('/[^\x20-\x7E]/', '', $out);
        };

        $pdf = new \FPDF('P','mm','A4');
        $pdf->SetTitle($ascii('Resume du regime - ' . ($regime['nom'] ?? '')));
        $pdf->AddPage();
        $pdf->SetFont('Helvetica','B',14);
        $pdf->Cell(0,10,$ascii($regime['nom'] ?? 'Regime'),0,1,'C');
        $pdf->Ln(4);

        // Table (label / value)
        $pdf->SetFont('Helvetica','B',11);
        $pdf->Cell(60,8,'Champ',1,0,'C');
        $pdf->Cell(120,8,'Valeur',1,1,'C');

        $pdf->SetFont('Helvetica','',11);
        $rows = [
            ['Nom', $regime['nom'] ?? ''],
            ['Description', $regime['description'] ?? ''],
            ['Prix journalier', number_format((float)$regime['prixJournalier'], 2, ',', ' ') . ' EUR'],
            ['Duree jours', (string) ($regime['dureeInfluencefood'] ?? '-')],
            ['Variation kg/cycle', (string) ($regime['poidsInfluencefood'] ?? '-')],
            ['Activite ID', (string) ($regime['idActivite'] ?? '-')],
            ['Date achat', (string) ($purchase['dateChoix'] ?? '')]
        ];

        foreach ($rows as $r) {
            $label = $ascii($r[0]);
            $value = $ascii($r[1]);
            $pdf->Cell(60,8,$label,1,0);
            // for long values use MultiCell in cell area
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->MultiCell(120,8,$value,1);
            // after MultiCell the position is at next line; ensure consistent
        }

        $filename = 'regime-' . ((int)$id) . '-user-' . $userId . '.pdf';
        return $this->response->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($pdf->Output('S'));
    }
}