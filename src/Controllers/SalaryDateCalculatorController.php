<?php

/**
 * Salary Dates Generator
 *
 * @author Bhushan Gaykawad <b.gaykawad@easternenterprise.com>
 */

declare(strict_types=1);

namespace EE\Controllers;

use EE\Services\Contracts\LoggerInterface;
use EE\Services\Contracts\SalaryDateCalculatorInterface;

class SalaryDateCalculatorController
{
    /**
     * @var SalaryDateCalculatorInterface
     */
    private $service;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Injects Salary Date Services
     *
     * @param SalaryDateCalculatorInterface $service
     * @param LoggerInterface $logger
     *
     * @return void
     */
    public function __construct(SalaryDateCalculatorInterface $service, LoggerInterface $logger)
    {
        $this->service = $service;
        $this->logger = $logger;
    }

    /**
     * Generates CSV file for salary dates
     *
     * @param string $filename
     *
     * @return void
     */
    public function generate(string $filename): void
    {
        $data = $this->service->getData();

        $this->logger->output($data, $filename);
    }
}
