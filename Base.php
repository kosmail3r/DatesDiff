<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 10/28/17
 * Time: 1:28 AM
 */

class Base
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
     * Base constructor.
     * @param string $strDate
     */
    public function __construct(DateValidator $validateResult)
    {
        $this->strDate = $validateResult['start'];
        $this->endDate = $validateResult['end'];
    }

    public function getDiff()
    {
        $yearStart = (substr($this->strDate[0], 0, 4));
        $monthStart = $this->strDate[1];
        $dayStart = $this->strDate[2];

        $yearEnd = (substr($this->endDate[0], 0, 4));
        $monthEnd = $this->endDate[1];
        $dayEnd = $this->endDate[2];

        //check by invert range

        if ($yearEnd < $yearStart ||
            $yearEnd == $yearStart && $monthEnd < $monthStart ||
            $yearEnd == $yearStart && $monthEnd == $monthStart && $dayEnd < $dayStart) {
            $this->invert = true;
        } else {
            $this->years = $yearEnd - $yearStart;
            if (!$this->years) {
                $this->months = $monthEnd - $monthStart;
                if (!$this->months) {
                    $this->totalDays = $this->days = $dayEnd - $dayStart;
                } else {

                }
            } else {

            }
        }

    }

    /**
     * @return int
     */
    public function getYears()
    {
        return $this->years;
    }


    /**
     * @return int
     */
    public function getMonths()
    {
        return $this->months;
    }


    /**
     * @return int
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @return int
     */
    public function getTotalDays()
    {
        return $this->total_days;
    }


    /**
     * @return bool
     */
    public function isInvert()
    {
        return $this->invert;
    }

}