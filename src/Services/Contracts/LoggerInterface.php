<?php

/**
 * Contract for Logging Data
 *
 * @author Bhushan Gaykawad <b.gaykawad@easternenterprise.com>
 */

declare(strict_types=1);

namespace EE\Services\Contracts;

interface LoggerInterface
{
    /**
     * Logs the output of given data
     *
     * @param array $data
     * @param string $filename
     *
     * @return void
     */
    public function output(array $data, string $filename): void;
}
