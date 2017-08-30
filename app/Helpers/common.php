<?php

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
