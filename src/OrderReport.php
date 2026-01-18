<?php

namespace App;

use App\DataRepository;
use App\Services\LoyaltyDiscountService;
use App\Services\TotalDiscountService;
use App\Services\VolumeDiscountService;

final class OrderReport
{
    public function generate(): array
    {
        $data = new DataRepository();
        $customers = $data->loadCustomers();

        $volumeService = new VolumeDiscountService();
        $totalService  = new TotalDiscountService();
        $loyaltyService = new LoyaltyDiscountService();

        //récupérer les résultats
        $volumeDiscounts = $volumeService->calculateVolumeDiscount();
        $totalDiscounts  = $totalService->calculateTotalDiscount();
        $loyaltyDiscount = $loyaltyService->calculateLoyaltyDiscount();

        $reportData = [];

        foreach ($customers as $customerId => $customer) {

            $reportData[] = sprintf(
                'Customer: %s (%s)',
                $customer['name'],
                $customerId
            );

            $reportData[] = sprintf(
                'Level: %s | Zone: %s | Currency: %s',
                $customer['level'],
                $customer['shipping_zone'],
                $customer['currency']
            );

            $volume = $volumeDiscounts[$customerId] ?? 0.0;
            $total  = $totalDiscounts[$customerId] ?? 0.0;

            $reportData[] = sprintf('Discount: %.2f', $total);
            $reportData[] = sprintf('  - Volume discount: %.2f', $volume);
            $reportData[] = sprintf('  - Loyalty discount: %.2f', $loyaltyDiscount);

            $reportData[] = str_repeat('-', 45);
        }
        return $reportData;
    }
}