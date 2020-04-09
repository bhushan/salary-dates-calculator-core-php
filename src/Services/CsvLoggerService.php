<?php

/**
 * Service to Log Data into CSV file
 *
 * @author Bhushan Gaykawad <b.gaykawad@easternenterprise.com>
 */

declare(strict_types = 1);

namespace EE\Services;

use EE\Services\Contracts\LoggerInterface;

class CsvLoggerService implements LoggerInterface
{
    /**
     * Filepath
     *
     * @var string
     */
    private const FILEPATH = 'public/%s.csv';

    /**
     * Outputs given data to CSV file
     *
     * @param array $data
     * @param string $filename
     *
     * @return void
     */
    public function output( array $data, string $filename ): void
    {
        $content = '';

        foreach ( $data as $row ) {
            $content .= implode(',', $row) . "\n";
        }

        $filePath = sprintf(self::FILEPATH, $filename);

        file_put_contents($filePath, $content);
    }
}
