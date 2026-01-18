<?php

namespace App\services;


use App\Services\VolumeDiscountService;
use App\Services\LoyaltyDiscountService;
use App\Config\CalculConfig;

final class TotalDiscountService{

    public function calculateTotalDiscount(){


        $repoVolumeDiscount = new VolumeDiscountService();
        $repoLoyaltyDiscount = new LoyaltyDiscountService();

        // Remises volume/fidélité
        $volumeDiscounts = $repoVolumeDiscount->calculateVolumeDiscount();
        $loyaltyDiscount = $repoLoyaltyDiscount->calculateLoyaltyDiscount();

        $totalDiscount = [];

        foreach ($volumeDiscounts as $customerId => $volumeDiscount) {

            //Somme totale des remises
            $resultTotalDiscount = $loyaltyDiscount + $volumeDiscount;

            if ($resultTotalDiscount > CalculConfig::MAX_DISCOUNT){
                $resultTotalDiscount = CalculConfig::MAX_DISCOUNT;
            }

            $totalDiscount[$customerId] = $resultTotalDiscount;
        }
        return $totalDiscount;
    }
}
