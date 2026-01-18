<?php

namespace App\tests;

use App\OrderReport;
use PHPUnit\Framework\TestCase;

final class OrderReportTest extends TestCase
{
    public function testReportGeneratesTextLines(): void
    {
        $report = new OrderReport();
        $lines = $report->generate();

        $this->assertIsArray($lines);
        $this->assertNotEmpty($lines);

        $this->assertStringContainsString('Customer:', $lines[0]);
    }
}

