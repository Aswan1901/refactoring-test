<?php

namespace App\Services;

use App\DataRepository;
use App\Config\CalculConfig;

final class LoyaltyDiscountService
{
    public function calculateLoyaltyDiscount(): array
    {
        $loyaltyPoints = [];

        $repo = new DataRepository();
        $orders = $repo->loadOrders();

        foreach ($orders as $order) {
            $cid = $order['customer_id'];

            if (!isset($loyaltyPoints[$cid])) {
                $loyaltyPoints[$cid] = 0;
            }

            $loyaltyPoints[$cid] +=
                $order['quantity'] * $order['unit_price'] * CalculConfig::LOYALTY_RATIO;
        }

        return $loyaltyPoints;
    }
}
