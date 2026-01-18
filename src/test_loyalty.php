<?php


require __DIR__ . '/../vendor/autoload.php';

use App\Services\LoyaltyDiscountService;
use App\TotalOrderRepository;
use App\Services\VolumeDiscountService;
use App\DataRepository;
use App\Services\TotalDiscountService;
use App\Services\TaxService;
$service = new LoyaltyDiscountService();
$total = new TotalOrderRepository();

$subTotal = new VolumeDiscountService();
$customers = new DataRepository();
$totalDiscount = new TotalDiscountService();
$tax = new TaxService();
//print_r($service->calculateLoyaltyDiscount());
//print_r($total->getTotalOrders());

//print_r($subTotal->calculateVolumeDiscount());
//print_r($customers->loadCustomers());
//print_r($customers->loadOrders());
//print_r($totalDiscount->calculateTotalDiscount());
print_r($tax->calculateTaxesByCustomer());

