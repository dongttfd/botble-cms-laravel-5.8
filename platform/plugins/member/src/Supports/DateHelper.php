<?php

namespace Botble\Member\Supports;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Convert datetime from human format to system format and timezone
     *
     * @param $timestamp
     * @param $tz
     * @return Carbon
     */
    public static function fromHumanToSystem($timestamp, $tz)
    {
        return Carbon::createFromFormat('Y/m/d H:i A', $timestamp, $tz)
            ->setTimezone(env('APP_DEFAULT_TIMEZONE'));
    }

    /**
     * Convert datetime to timezone
     *
     * @param $timestamp
     * @param $tz
     * @return Carbon
     */
    public static function convertToTimezone($timestamp, $tz)
    {
        return Carbon::createFromTimestamp(strtotime($timestamp), env('APP_DEFAULT_TIMEZONE'))->setTimezone($tz);
    }

    /**
     * Update datetime according frequency type.
     *
     * @param Carbon $date
     * @param $frequency
     * @param $number
     * @return Carbon
     */
    public static function addTimeAccordingToFrequencyType(Carbon $date, $frequency, $number)
    {
        switch ($frequency) {
            case 'day':
                $date->addDays($number);
                break;
            case 'week':
                $date->addWeeks($number);
                break;
            case 'month':
                $date->addMonths($number);
                break;
            default:
                $date->addYears($number);
                break;
        }

        return $date;
    }
}
