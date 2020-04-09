<?php

/**
 * Contract for Salary Dates
 *
 * @author Bhushan Gaykawad <b.gaykawad@easternenterprise.com>
 */

declare(strict_types = 1);

namespace EE\Services\Contracts;

interface SalaryDateCalculatorInterface
{
    /**
     * Get Data
     *
     * @return array
     */
    public function getData(): array;
}
