<?php

/**
 * Salary Date Calculator Service Tests
 *
 * @author Bhushan Gaykawad <b.gaykawad@easternenterprise.com>
 */

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use EE\Services\SalaryDateCalculatorService;

class SalaryDateCalculatorServiceTest extends TestCase
{
    /**
     * @var SalaryDateCalculatorService
     */
    private $service;

    /**
     * Sets Up environment for each test for this class
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new SalaryDateCalculatorService();
    }

    public function testVerifiesThatCorrectPaymentDateIsReturnedWhenItsLastWeekdayOfTheMonth()
    {
        $date = date_create('01-05-2020');

        $this->assertEquals('29-May-2020', $this->service->getPaymentDate($date));
    }

    public function testVerifiesThatCorrectPaymentDateIsReturnedWhenLastDateOfTheMonthIsWeekday()
    {
        $date = date_create('01-03-2020');

        $this->assertEquals('31-Mar-2020', $this->service->getPaymentDate($date));
    }

    public function testVerifiesThatCorrectBonusPaymentDateIsReturnedWhenItsWeekendOnFifteenth()
    {
        $date = date_create('01-02-2020');

        $this->assertEquals('19-Feb-2020', $this->service->getBonusPaymentDate($date));
    }

    public function testVerifiesCorrectBonusPaymentDateIsReturnedIfItIsWeekday()
    {
        $date = date_create('01-04-2020');

        $this->assertEquals('15-Apr-2020', $this->service->getBonusPaymentDate($date));
    }
}
