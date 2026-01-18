<?php

namespace App\Services;

use App\TotalOrderRepository;
use App\DataRepository;
final class VolumeDiscountService
{
    public function calculateVolumeDiscount()
    {
        $repo = new TotalOrderRepository();
        $subtotals = $repo->getTotalOrders();

        $data = new DataRepository();
        $customers = $data->loadCustomers();
        $dateOfOrders = $data->loadOrders();

        $discounts = [];

        foreach ($subtotals as $customerId => $subtotal) {

            $disc = 0.0;

            // récupérer le niveau DU client courant
            $level = $customers[$customerId]['level'] ?? 'STANDARD';

            // remise par palier
            if ($subtotal > 1000 && $level === 'PREMIUM') {
                $disc = $subtotal * 0.20;
            } elseif ($subtotal > 500) {
                $disc = $subtotal * 0.15;
            } elseif ($subtotal > 100) {
                $disc = $subtotal * 0.10;
            } elseif ($subtotal > 50) {
                $disc = $subtotal * 0.05;
            }

            //bonus week-end POUR CE CLIENT
            if (!empty($dateOfOrders[$customerId]['date'])) {

                $dt = new \DateTimeImmutable($dateOfOrders[$customerId]['date']);
                $dayOfWeek = (int) $dt->format('N'); // 6 = samedi, 7 = dimanche

                if ($dayOfWeek === 6 || $dayOfWeek === 7) {
                    $disc *= 1.05;
                }
            }
            $discounts[$customerId] = $disc;
        }
        return $discounts;
    }
}
