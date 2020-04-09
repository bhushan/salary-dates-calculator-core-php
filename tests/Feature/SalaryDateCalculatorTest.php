<?php

/**
 * Salary Date Calculator Tests
 *
 * @author Bhushan Gaykawad <b.gaykawad@easternenterprise.com>
 */

declare(strict_types = 1);

namespace Tests\Feature;

use Mockery;
use PHPUnit\Framework\TestCase;
use EE\Controllers\SalaryDateCalculatorController;
use EE\Services\Contracts\SalaryDateCalculatorInterface;
use EE\Services\CsvLoggerService;

class SalaryDateCalculatorTest extends TestCase
{
    /**
     * Test specific filename
     *
     * @var string
     */
    private $filename = 'testFile';
    /**
     * @var SalaryDateCalculatorController
     */
    private $salaryDate;

    /**
     * Sets Up environment for each test for this class
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $m = Mockery::mock(SalaryDateCalculatorInterface::class);

        $m->shouldReceive('getData')->once()->andReturn($this->dummyData());

        $this->salaryDate = new SalaryDateCalculatorController($m, new CsvLoggerService());
    }

    /**
     * Closes mockery to check that the method was called as expected
     * Deletes test generated file
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();

        unlink('public/' . $this->filename . '.csv');
    }

    public function testVerifiesThatCsvFileIsGenerated()
    {
        $this->salaryDate->generate($this->filename);

        $this->assertFileExists('public/' . $this->filename . '.csv');
    }

    /**
     * Dummy Data
     *
     * @return array
     */
    private function dummyData(): array
    {
        return [
            ['Month Name', 'Payment Date', 'Bonus Payment Date'],
            ['January', '31-Jan-2020', '15-Jan-2020']
        ];
    }
}
