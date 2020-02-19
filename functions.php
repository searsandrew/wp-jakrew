<?php

/**
 * Store Is Open takes an array of times and checks to see if the current time is within it.
 * 
 * @todo Pull data from Database
 * @return string
 */
function storeIsOpen() {
    $storeSchedule = [
        'Sun' => ['12:00 PM' => '06:00 PM'],
        'Mon' => ['04:00 PM' => '10:00 PM'],
        'Tue' => ['04:00 PM' => '10:00 PM'],
        'Wed' => ['04:00 AM' => '10:00 PM'],
        'Thu' => ['03:00 PM' => '10:00 PM'],
        'Fri' => ['03:00 PM' => '12:00 AM'],
        'Sat' => ['12:00 AM' => '01:30 AM', '09:00 AM' => '11:00 PM']
    ];
    // current or user supplied UNIX timestamp
    $timestamp = time();

    // default status
    $status = FALSE;

    // get current time object
    $currentTime = (new DateTime('America/Chicago'))->setTimestamp($timestamp);

    // loop through time ranges for current day
    foreach ($storeSchedule[date('D', $timestamp)] as $startTime => $endTime) {

        // create time objects from start/end times
        $startTime = DateTime::createFromFormat('h:i A', $startTime, new DateTimeZone('America/Chicago'));
        $endTime   = DateTime::createFromFormat('h:i A', $endTime, new DateTimeZone('America/Chicago'));

        // check if current time is within a range
        if (($startTime < $currentTime) && ($currentTime < $endTime)) {
            return 'We are Open until '.$endTime->format('g:i A');
        }

        // set status to open time
        if (($startTime > $currentTime) && ($currentTime < $endTime)) {
            return 'Open today at '.$startTime->format('g:i A');
        } elseif (($startTime < $currentTime) && ($currentTime > $endTime)) {
            return 'Open tomorrow at ';
        } else {
            return 'We are currently Closed.';
        }
    }

    return $status;
}