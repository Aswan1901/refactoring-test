<?php


require __DIR__ . '/../vendor/autoload.php';

use App\Services\LoyaltyDiscountService;
use App\TotalOrderRepository;

$service = new LoyaltyDiscountService();
$total = new TotalOrderRepository();

print_r($service->calculateLoyaltyDiscount());
print_r($total->getTotalOrders());

