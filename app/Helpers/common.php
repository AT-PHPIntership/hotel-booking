<?php

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
     * @param string $content string content
     *
     * @return string
     */
    function contentLimit($content = '')
    {
        $contentLength = strlen($content);
        $shortencontent = mb_substr(
            $content,
            START_POSITION,
            LIMIT_LENGTH,
            UNICODE_FORMAT
        ) . SUFFIX;
        return ($contentLength > LIMIT_LENGTH) ? $shortencontent : $content;
    }
}

if (!function_exists('getRoundFloat')) {

    /**
     * Get round number float
     *
     * @param float $attribute attribute of object
     *
     * @return float
     */
    function getRoundFloat($attribute)
    {
        return sprintf("%.1f", $attribute);
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
    function getProgressPercent($avgRating) {
        return $avgRating * RATING_FACTOR;
    }
}
