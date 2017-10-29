<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 10/28/17
 * Time: 11:30 PM
 */

class DateBase
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
     * DateBase constructor.
     * @param int $years
     * @param int $months
     * @param int $days
     * @param int $totalDays
     * @param bool $invert
     */
    public function __construct($years, $months, $days, $totalDays, $invert)
    {
        $this->years = $years;
        $this->months = $months;
        $this->days = $days;
        $this->totalDays = $totalDays;
        $this->invert = $invert;
    }


}