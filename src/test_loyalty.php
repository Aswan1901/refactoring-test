<?php


require __DIR__ . '/../vendor/autoload.php';

use App\Services\LoyaltyDiscountService;
use App\TotalOrderRepository;
use App\Services\VolumeDiscountService;
use App\DataRepository;
use App\Services\TotalDiscountService;
use App\Services\TaxService;
use App\OrderReport;

$service = new LoyaltyDiscountService();
$total = new TotalOrderRepository();

$subTotal = new VolumeDiscountService();
$customers = new DataRepository();
$totalDiscount = new TotalDiscountService();
$tax = new TaxService();
$reportData = new OrderReport();


//print_r($service->calculateLoyaltyDiscount());
//print_r($total->getTotalOrders());

//print_r($subTotal->calculateVolumeDiscount());
print_r($reportData->generate());
//print_r($customers->loadOrders());
//print_r($totalDiscount->calculateTotalDiscount());
//print_r($tax->calculateTaxesByCustomer());

