<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 10/28/17
 * Time: 1:27 AM
 */

use Base;

$startDate = '2016-10-30';
$endDate = '2016-11-02';

$validator = new DateValidator($startDate, $endDate);
$validateResult = $validator->validate();

if (isset($validateResult['success'])) {
    $base = new Base($validateResult);
}

