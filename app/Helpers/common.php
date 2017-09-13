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
