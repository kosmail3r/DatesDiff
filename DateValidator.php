<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 10/28/17
 * Time: 1:57 AM
 */

class DateValidator
{
    /**
     * @var string
     */
    private $regularPattern = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';

    /**
     * @var string date in format «YYYY-MM-DD» ( Like 2015-03-05 )
     */
    private $startDate;

    /**
     * @var string date in format «YYYY-MM-DD» ( Like 2015-03-05 )
     */
    private $endDate;

    /**
     * DateValidator constructor.
     * @param string $startDate
     * @param string $endDate
     */
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return  array
     */
    public function validate ()
    {
        $src = ['success' => true];
        $msg = ['success' => false];
        $validateStart = preg_match($this->regularPattern, $this->startDate, $src['start']);
        $validateEnd = preg_match($this->regularPattern, $this->endDate, $src['end']);
        if (!$validateStart) $msg[] = 'Incorect start date format';
        if (!$validateEnd) $msg[] = 'Incorect end date format';
        return (count($msg) > 1) ? $msg : $src;
    }

}