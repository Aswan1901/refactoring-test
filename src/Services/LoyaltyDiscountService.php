<?php

namespace App\Services;

use App\DataRepository;
use App\Config\CalculConfig;

final class LoyaltyDiscountService
{
    public function calculateLoyaltyPoints(): float|int
    {
        $ordersData = new DataRepository();
        $orders = $ordersData->loadOrders();

        $points = 0;

        foreach ($orders as $customerId => $order) {
            $qty = $order['quantity'] ?? 1;
            $points += $qty * $order['unit_price'] * CalculConfig::LOYALTY_RATIO;
        }
        return $points;
    }

    public function calculateLoyaltyDiscount(): float|int
    {

        $points = $this->calculateLoyaltyPoints();

        if ($points > 500) {
            return min($points * 0.15, 100.0);
        } elseif ($points > 100) {
            return min($points * 0.10, 50.0);
        }
            return 0.0;
    }
}

