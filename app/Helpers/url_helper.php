<?php

if (!function_exists('auto_link_text')) {
    function auto_link_text($text) {
        // This regex pattern will match URLs in the text
        $pattern = "/\b(?:https?:\/\/|www\.)\S+\b/i";

        // Replace URLs with clickable links
        $text = preg_replace_callback($pattern, function($matches) {
            $url = $matches[0];

            // Add "http://" to URLs that start with "www."
            if (strpos($url, 'www.') === 0) {
                $url = 'http://' . $url;
            }

            // Make sure the displayed text is not too long
            $displayText = strlen($url) > 50 ? substr($url, 0, 47) . '...' : $url;

            return '<a href="' . $url . '" target="_blank" rel="noopener noreferrer">' . $displayText . '</a>';
        }, $text);

        return $text;
    }
}