<?php

namespace App;

use App\DataRepository;

class TotalOrderRepository
    {
        public function getTotalOrders():array
        {

            $repo = new DataRepository();
            //recupere les customers et orders
            $orders = $repo->loadOrders();
            $customers = $repo->loadCustomers();

            $totalOrders=[];

            foreach ($customers as $customer) {
                $customersById[$customer['id']] = $customer;
            }

            foreach ($orders as $order) {
                $customerId = $order['customer_id'];
                $unitPrice = $order['unit_price'];

                if (!isset($customersById[$customerId])) {
                    continue;
                }

                if (!isset($totalOrders[$customerId])) {
                    $totalOrders[$customerId] = 0;
                }

                $totalOrders[$customerId] += $unitPrice;

            }

            return $totalOrders;
        }
    }
