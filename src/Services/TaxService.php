<?php

namespace App\Services;

use App\Config\CalculConfig;
use App\DataRepository;
final class TaxService
{
    public function calculateTaxesByCustomer(): array
    {
        $data = new DataRepository();

        $orders = $data->loadOrders();
        $products = $data->loadProducts();

        $taxesByCustomer = [];

        // Regrouper les commandes par client
        $ordersByCustomer = [];
        foreach ($orders as $order) {
            $ordersByCustomer[$order['customer_id']][] = $order;
        }

        foreach ($ordersByCustomer as $customerId => $items) {

            $tax = 0.0;
            $allTaxable = true;
            $taxableTotal = 0.0;

            // Vérifier si tous les produits sont taxables
            foreach ($items as $item) {

                $prod = $products[$item['product_id']] ?? null;

                // Normalisation string -> bool
                $isTaxable = true;
                if ($prod && isset($prod['taxable'])) {
                    $isTaxable = filter_var($prod['taxable'], FILTER_VALIDATE_BOOLEAN);
                }

                if (!$isTaxable) {
                    $allTaxable = false;
                    break;
                }

                $taxableTotal += $item['quantity'] * $item['unit_price'];
            }

            // Calcul de la taxe
            if ($allTaxable) {

                $tax = round($taxableTotal * CalculConfig::RATE, 2);

            } else {

                foreach ($items as $item) {

                    $prod = $products[$item['product_id']] ?? null;

                    $isTaxable = true;
                    if ($prod && isset($prod['taxable'])) {
                        $isTaxable = filter_var($prod['taxable'], FILTER_VALIDATE_BOOLEAN);
                    }

                    if ($isTaxable) {
                        $lineTotal = $item['quantity'] * $item['unit_price'];
                        $tax += $lineTotal * CalculConfig::RATE;
                    }
                }

                $tax = round($tax, 2);
            }

            $taxesByCustomer[$customerId] = $tax;
        }

        return $taxesByCustomer;
    }
}



