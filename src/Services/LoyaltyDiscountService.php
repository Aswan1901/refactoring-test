<?php

namespace App\Services;

use App\DataRepository;
use App\Config\CalculConfig;

final class LoyaltyDiscountService
{
    public function calculateLoyaltyPoints(array $orders): int
    {
        $points = 0;

        foreach ($orders as $order) {
            $qty = $order['qty'] ?? 1;
            $points += $qty * $order['unit_price'] * CalculConfig::LOYALTY_RATIO;
        }

        return $points;
    }

    public function calculateLoyaltyDiscount(int $points): float
    {
        if ($points > 500) {
            return min($points * 0.15, 100.0);
        }

        if ($points > 100) {
            return min($points * 0.10, 50.0);
        }

        return 0.0;
    }
}

