<?php

use App\DataRepository;

class LoyaltyDiscountService
{
    public function CalculateLoyaltyDiscount($order)
    {
        $loyaltyPoints = [];

        $repo = new DataRepository();

        $orders = $repo->loadOrders();
        foreach ($orders as $order) {
            $cid = $order['customer_id'];

            if (!isset($loyaltyPoints[$cid])) {
                $loyaltyPoints[$cid] = 0;
            }

            //calcul sur prix commande
            $loyaltyPoints[$cid] += $order['qty'] * $order['unit_price'] * 0.1;


        }




    }

}
