<?php

namespace App\Service;

use App\Entity\Phone;

class PriceManager
{
    public function getPrice(Phone $phone): string
    {
        $scoreMin = 300;
        $scoreMax = 26800;
        $prixMin = 80;
        $prixMax = 400;
        $pente = ($prixMax - $prixMin) / ($scoreMax - $scoreMin);
        $yOrigin = $prixMin - $pente * $scoreMin;

        $score = ((int)$phone->getRam() + (int)$phone->getStockage()) * ((int)$phone->getEtat() * 10);
        if ($score === 0) {
            return '0';
        }
        $prix = $pente * $score + $yOrigin;
        $prix = number_format($prix, 2, ',', ' ');
        return $prix;
    }
}
