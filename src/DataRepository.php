<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

use App\DataLoader;

class DataRepository
{
    public function loadCustomers(): array
    {
        $base = __DIR__;
        $path = $base . '/../legacy/data/customers.csv';

        $rows = DataLoader::loadData($path);

        $customers = [];
        foreach ($rows as $row) {
            $customers[$row['id']] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'level' => $row['level'] ?? 'BASIC',
                'shipping_zone' => $row['shipping_zone'] ?? 'ZONE1',
                'currency' => $row['currency'] ?? 'EUR',
            ];
        }

        return $customers;
    }

//    public function loadProducts(): array
//    {
//        $base = __DIR__;
//        $path = $base . '/../legacy/data/products.csv';
//        $rows = DataLoader::loadData($path);
//        $products = [];
//        foreach ($rows as $row) {
//            $products [$row['id']] = [
//                'id' => $row['id'],
//                'name' => $row['name'],
//                'category'=> $row['category'],
//                'weight' => $row['weight'],
//                'taxable' => $row['taxable'],
//            ];
//        }
//        return $products;
//    }
//
    public function loadOrders(): array
    {
        $base = __DIR__;
        $path = $base . '/../legacy/data/orders.csv';
        $rows = DataLoader::loadData($path);
        $orders = [];
        foreach ($rows as $row)
        {
            $orders [$row['id']] = [
                'id' => $row['id'],
                'customer_id' => $row['customer_id'],
                'product_id' => $row['product_id'],
                'unit_price' => $row['unit_price'],
                'quantity' => $row['qty'],
                'date' => $row['date'],
                'promo_code' => $row['promo_code'],
                'time' => $row['time'],
            ];
        }
        return $orders;
    }
//
//    public function loadPromotions(): array
//    {
//        $base = __DIR__;
//        $path = $base . '/../legacy/data/promotions.csv';
//        $rows = DataLoader::loadData($path);
//        $promotions = [];
//        foreach ($rows as $row)
//        {
//            $promotions [$row['code']] =[
//                'code' => $row['code'],
//                'type' => $row['type'],
//                'value' => $row['value'],
//                'active' => $row['active'],
//            ];
//        }
//        return $promotions;
//    }
//
//    public function loadShippingZones(): array
//    {
//        $base = __DIR__;
//        $path = $base . '/../legacy/data/shipping_zones.csv';
//        $rows = DataLoader::loadData($path);
//        $zones = [];
//        foreach ($rows as $row)
//        {
//            $zones [$row['zone']] = [
//                'zone' => $row['zone'],
//                'base' => $row['base'],
//                'per_kg' => $row['per_kg'],
//            ];
//        }
//        return $zones;
//    }
}

try {
    $repo = new DataRepository();
    $customers = $repo->loadCustomers();
   // $products = $repo->loadProducts();
    $orders = $repo->loadOrders();
   // $shippingZones = $repo->loadShippingZones();
   // $promoCodes = $repo->loadPromotions();


    //echo "Successfully loaded " . count($customers) . " customers\n\n";
   // echo "Successfully loaded " . count($products) . "\n";
    //echo "Successfully loaded " . count($orders) . "\n";
   // echo "Successfully loaded " . count($shippingZones) . "\n";
   // echo "Successfully loaded " . count($promoCodes) . "\n";

    //print_r($customers);
   // print_r($products);
    //($orders);
    //print_r($shippingZones);
    //print_r($promoCodes);


} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}