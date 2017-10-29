<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 10/28/17
 * Time: 1:28 AM
 */

class DateChecker
{
    /**
     * @var integer
     */
    private $years = 0;
    /**
     * @var integer
     */
    private $months = 0;
    /**
     * @var integer
     */
    private $days = 0;
    /**
     * @var integer
     */
    private $totalDays = 0;
    /**
     * @var boolean
     * true if start date after ending date
     */
    private $invert = false;

    /**
     * @var array
     */
    public $startDateArray;

    /**
     * @var array
     */
    public $endDateArray;

    /**
     * DateChecker constructor.
     * @param string $strDate
     */
    public function __construct(array $validateResult)
    {
        $this->strDate = $validateResult['start'];
        $this->endDate = $validateResult['end'];
    }

    /**
     * @return bool|DateBase
     */
    public function getDiff()
    {
        $yearStart = (int)(substr($this->strDate[0], 0, 4));
        $monthStart = (int)$this->strDate[1];
        $dayStart = (int)$this->strDate[2];

        $yearEnd = (int)(substr($this->endDate[0], 0, 4));
        $monthEnd = (int)$this->endDate[1];
        $dayEnd = (int)$this->endDate[2];

        //check by invert range

        if ($yearEnd < $yearStart ||
            $yearEnd == $yearStart && $monthEnd < $monthStart ||
            $yearEnd == $yearStart && $monthEnd == $monthStart && $dayEnd < $dayStart) {
            $this->invert = true;
            return false;
        } else {
            $this->years = $yearEnd - $yearStart;
            if (!$this->years) {
                $this->monthsAndDaysCount([$monthStart, $dayStart], [$monthEnd, $dayEnd], $yearEnd);
            } else {
                //split date range
                $range = [];
                $sD = [$monthStart, $dayStart];
                $eD = $target = [$monthEnd, $dayEnd];
                for ($i = $this->years; $i >= 0; $i--) {
                    $range [] = [
                        'year' => $yearEnd - $i,
                        'dateStart' => $sD,
                        'endDate' => ($i) ? [12, 31] : $eD,
                    ];
                    $sD = [1, 1];
                }
                foreach ($range as $simple) {
                    $this->monthsAndDaysCount($simple['dateStart'], $simple['endDate'], $simple['year']);
                }
            }
        }
        return new DateBase($this->years, $this->months, $this->days, $this->totalDays, $this->invert);
    }

    /**
     * @param $startDate (array) [ MM, DD ]
     * @param $endDate (array) [ MM, DD ]
     * @param $year (integer)
     * @return DateBase
     */
    private function monthsAndDaysCount($startDate, $endDate, $year)
    {
        $monthStart = $startDate[0];
        $monthEnd = $endDate[0];
        $dayStart = $startDate[1];
        $dayEnd = $endDate[1];
        $calendarData = new Calendar($year);

        $monthsDiff = $monthEnd - $monthStart;
        if (!$monthsDiff) {
            $daysDiff = $dayEnd - $dayStart;
        } else {
            //Days check
            if ($dayStart > $dayEnd && !$monthsDiff) {
                $monthsDiff--;
                $daysDiff = $dayEnd - $dayStart;
            } else {
                $monthsDiff--;
                $totalStartMonthDays = $calendarData->days[$monthStart];
                $daysDiff = $totalStartMonthDays - $dayStart + $dayEnd + 1;
            }
            if ($year % 4 === 0 && $monthStart == 2) $daysDiff++;
            if ($daysDiff > 30) {
                $daysDiff -= 31;
                $monthsDiff++;
            }
        }
        $totalDays = $calendarData->getCountDays($startDate, $endDate);
        $this->months += $monthsDiff;
        $this->days += $daysDiff;
        $this->totalDays += $totalDays;

        return new DateBase($this->years, $this->months, $this->days, $this->totalDays, $this->invert);
    }
}