<?php

namespace Eggysetiawan\DatetimePriod\Supports;

use Illuminate\Support\Carbon;

/**
 * @author Rahmat Setiawan <setiawaneggy@gmail.com>
 */
class DateSupport
{
    /**
     * Get an array of start of day and end of day.
     *
     * @param string $date (Format Y-m-d)
     * @param boolean $time (Format H:i:s)
     *
     * @return array
     */
    public function dayBetween(string $date, bool $time): array
    {
        $startOfDay = $time
        ? Carbon::parse($date)->startOfDay()->toDateTimeString()
        : Carbon::parse($date)->startOfDay()->toDateString();

        $endOfDay = $time
        ? Carbon::parse($date)->endOfDay()->toDateTimeString()
        : Carbon::parse($date)->endOfDay()->toDateString();

        return [
            $startOfDay,
            $endOfDay,
        ];
    }

    /**
     * Get an array of start of month and end of month
     *
     * @param string $month (format m / n)
     * @param string $year (format Y)
     * @param boolean $time (format H:i:s)
     *
     * @return array
     */
    public function monthBetween(string $month, string $year, bool $time): array
    {
        $month = sprintf('%02d', $month);

        $yearMonth = $year.$month;

        $startOfMonth = $time
        ? Carbon::createFromFormat('Ym', $yearMonth)->startOfMonth()->toDateTimeString()
        : Carbon::createFromFormat('Ym', $yearMonth)->startOfMonth()->toDateString();

        $endOfMonth = $time
        ? Carbon::createFromFormat('Ym', $yearMonth)->endOfMonth()->toDateTimeString()
        : Carbon::createFromFormat('Ym', $yearMonth)->endOfMonth()->toDateString();

        return [
            $startOfMonth,
            $endOfMonth,
        ];
    }

    /**
     * Get an array of start of year and end of year
     *
     * @param string $year (format Y)
     * @param boolean $time (format H:i:s)
     *
     * @return array
     */
    public function yearBetween(string $year, bool $time): array
    {
        $startOfYear = $time
        ? Carbon::parse($year)->startOfYear()->toDateTimeString()
        : Carbon::parse($year)->startOfYear()->toDateString();

        $endOfYear = $time
        ? Carbon::parse($year)->endOfYear()->toDateTimeString()
        : Carbon::parse($year)->endOfYear()->toDateString();

        return [
            $startOfYear,
            $endOfYear,
        ];
    }

    /**
     * Get date given month and given year
     *
     * @param string $month
     * @param string $year
     * @param boolean $time
     *
     * @return string
     */
    public function monthUntil(string $month, string $year, bool $time): string
    {
        $month = sprintf('%02d', $month);

        return $time
        ? Carbon::createFromFormat('Ym', $year.$month)->endOfMonth()->toDateTimeString()
        : Carbon::createFromFormat('Ym', $year.$month)->endOfMonth()->toDateString();
    }
}
