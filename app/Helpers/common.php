<?php

use App\Model\Reservation;
use App\Model\Room;
use Carbon\Carbon;

if (!function_exists('isActiveRoute')) {
    
    /**
     * Active menu side bar when route menu is current route
     *
     * @param string $route  route of page
     * @param string $output active or ''
     *
     * @return string
     */
    function isActiveRoute($route, $output = "active")
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}

if (!function_exists('areActiveRoute')) {

    /**
     * Active menu side bar when routes menu are current route
     *
     * @param Array  $routes routes action
     * @param string $output active or ''
     *
     * @return string
     */
    function areActiveRoute(array $routes, $output = "active")
    {
        if (in_array(Route::currentRouteName(), $routes, true)) {
            return $output;
        }
    }
}

/**
 * Start string truncating
 */
const START_POSITION = 0;

/**
 * Length limit of content will be display
 */
const LIMIT_LENGTH = 100;

/**
 * Format utf-8 for truncating content unicode
 */
const UNICODE_FORMAT = 'utf-8';

/**
 * Suffix ..., after truncating content
 */
const SUFFIX = '...';

if (!function_exists('contentLimit')) {

    /**
     * Limit length of content
     *
     * @param string $content     string content
     * @param int    $limitLenght length content
     *
     * @return string
     */
    function contentLimit($content = '', $limitLenght = LIMIT_LENGTH)
    {
        $contentLength = strlen($content);
        $shortencontent = mb_substr(
            $content,
            START_POSITION,
            $limitLenght,
            UNICODE_FORMAT
        ) . SUFFIX;
        return ($contentLength > $limitLenght) ? $shortencontent : $content;
    }
}

/**
 * Value of factor to convert rating to percent
 */
const RATING_FACTOR = 10;

if (!function_exists('getProgressPercent')) {
    
    /**
     * Get percent progress of rating attribute
     *
     * @param float $avgRating average rating
     *
     * @return float
     */
    function getProgressPercent($avgRating)
    {
        return $avgRating * RATING_FACTOR;
    }
}

if (!function_exists('formatDateTimeToDate')) {

    /**
     * Format date time string to date string
     *
     * @param string $strDateTime string date time
     *
     * @return Carbon
     */
    function formatDateTimeToDate($strDateTime)
    {
        return Carbon::parse($strDateTime)->format(config('hotel.date_format'));
    }
}

if (!function_exists('totalEmptyRoom')) {

    /**
     * Save creating reservation
     *
     * @param int      $roomId  id       of room
     * @param datetime $checkin datetime checkin
     *
     * @return \Illuminate\Http\Response
     */
    function totalEmptyRoom($roomId, $checkin)
    {
        $room = Room::findOrFail($roomId);
        $roomBusy = $room->reservations()
            ->where([
                ['status', Reservation::STATUS_ACCEPTED],
                ['checkin_date', '<=', $checkin],
                ['checkout_date', '>=', $checkin]
                ])
            ->get();
            $totalBusy = $roomBusy->sum('quantity');
        return $room->total - $totalBusy;
    }
}
