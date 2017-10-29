<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 10/29/17
 * Time: 12:08 AM
 */

class Calendar
{
    public $yearDays = 364;
    public $days = [
        1 => 31,    // Jun
        2 => 28,    // Feb
        3 => 31,    // Mar
        4 => 30,    // Apr
        5 => 31,    // May
        6 => 30,    // Jub
        7 => 31,    // Jul
        8 => 31,    // Aug
        9 => 30,    // Sep
        10 => 31,   // Oct
        11 => 30,   // Nov
        12 => 31    // Dec
    ];

    /**
     * Calendar constructor. Checking year
     * @param int $years
     *
     */
    public function __construct($year)
    {
        if ($year % 4 === 0) {
            $this->days[2] = 29;
            $this->yearDays = 365;
        }
        return $this->days;
    }

    public function getCountDays($fromDate, $toDate = false)
    {
        $daysCount = 0;
        if (!$toDate) $toDate = [12, 31];
        $monthRange = range($fromDate[0], $toDate[0]);
        if ($fromDate[1] > 1) {
            $daysCount += $this->days[$fromDate[0]] - $fromDate[1];
            $fromDate[1] = 1;
            $fromDate[0]++;
            array_shift($monthRange);
        }
        if ($toDate[1] != $this->days[$toDate[0]]) {
            $daysCount += $toDate[1];
            $toDate[0]--;
            array_pop($monthRange);
        }
        foreach ($monthRange as $month) {
            $daysCount += $this->days[$month];
        }
        return $daysCount;
    }

    public function getTotalMonthDays($month)
    {
        if (!in_array($month, $this->days)) return false;
        return $this->days[$month];
    }
}
