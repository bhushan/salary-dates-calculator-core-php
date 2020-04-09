<?php

/**
 * Service to get Salary Dates
 *
 * @author Bhushan Gaykawad <b.gaykawad@easternenterprise.com>
 */

declare(strict_types = 1);

namespace EE\Services;

use DateTime;
use EE\Services\Contracts\SalaryDateCalculatorInterface;

class SalaryDateCalculatorService implements SalaryDateCalculatorInterface
{
    /**
     * Get Rows data as formatted array
     *
     * @return array
     */
    public function getData(): array
    {
        $data[] = $this->addColumns();

        for ( $month = date('m'); $month <= 12; $month++ ) {
            $date = DateTime::createFromFormat('d-m', "01-{$month}");
            $data[$month][0] = $date->format('F');
            $data[$month][1] = $this->getPaymentDate($date);
            $data[$month][2] = $this->getBonusPaymentDate($date);
        }

        return $data;
    }

    /**
     * Columns to be added
     *
     * @return array
     */
    private function addColumns(): array
    {
        return ['Month Name', 'Payment Date', 'Bonus Payment Date'];
    }

    /**
     * Get Payment Date for the month
     *
     * @param DateTime $date
     *
     * @return string
     */
    public function getPaymentDate( DateTime $date ): string
    {
        if ( $this->isWeekend($this->getLastDayOfMonth($date)) ) {
            return $this->getLastFridayOfMonth($date)->format('d-M-Y');
        }

        return $this->getLastDayOfMonth($date)->format('d-M-Y');
    }

    /**
     * Get Bonus Payment Date for the month
     *
     * @param DateTime $date
     *
     * @return string
     */
    public function getBonusPaymentDate( DateTime $date ): string
    {
        $fifteenthDate = date_create("{$date->format('Y')}-{$date->format('M')}-15");

        if ( $this->isWeekend($fifteenthDate) ) {
            return $this->getNextWednesday($fifteenthDate)->format('d-M-Y');
        }

        return $fifteenthDate->format('d-M-Y');
    }

    /**
     * Get Last Day of the Month
     *
     * @param DateTime $date
     *
     * @return DateTime
     */
    private function getLastDayOfMonth( DateTime $date ): DateTime
    {
        return $date->modify('last day of this month');
    }

    /**
     * Checks if it is a Weekend
     *
     * @param DateTime $date
     *
     * @return bool
     */
    private function isWeekend( DateTime $date ): bool
    {
        return $date->format('N') >= 6;
    }

    /**
     * Get Last Friday of the Month
     *
     * @param DateTime $date
     *
     * @return DateTime
     */
    private function getLastFridayOfMonth( DateTime $date ): DateTime
    {
        return $date->modify('last Friday of this month');
    }

    /**
     * Get next Wednesday
     *
     * @param DateTime $date
     *
     * @return DateTime
     */
    private function getNextWednesday( DateTime $date ): DateTime
    {
        return $date->modify('next Wednesday');
    }
}
