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
    private $years;
    /**
     * @var integer
     */
    private $months;
    /**
     * @var integer
     */
    private $days;
    /**
     * @var integer
     */
    private $total_days;
    /**
     * @var boolean
     * true if start date after ending date
     */
    private $invert;

    /**
     * @var string date in format «YYYY-MM-DD» ( Like 2015-03-05)
     */
    public $startDate;

    /**
     * @var string date in format «YYYY-MM-DD» ( Like 2015-03-05)
     */
    public $endDate;

    /**
     * Base constructor.
     * @param string $strDate
     */
    public function __construct($strDate, $endDate)
    {
        $this->strDate = $strDate;
        $this->endDate = $endDate;
    }

    /**
     * @return int
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * @param int $years
     */
    public function setYears($years)
    {
        $this->years = $years;
    }

    /**
     * @return int
     */
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * @param int $months
     */
    public function setMonths($months)
    {
        $this->months = $months;
    }

    /**
     * @return int
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param int $days
     */
    public function setDays($days)
    {
        $this->days = $days;
    }

    /**
     * @return int
     */
    public function getTotalDays()
    {
        return $this->total_days;
    }

    /**
     * @param int $total_days
     */
    public function setTotalDays($total_days)
    {
        $this->total_days = $total_days;
    }

    /**
     * @return bool
     */
    public function isInvert()
    {
        return $this->invert;
    }

    /**
     * @param bool $invert
     */
    public function setInvert($invert)
    {
        $this->invert = $invert;
    }

}