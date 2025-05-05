<?php
if (!function_exists('sanitizeString')) {
    function sanitizeString($input)
    {
        // Remove unwanted characters
        $input = strip_tags($input);
        $input = preg_replace('/[^a-zA-Z0-9\s]/', '', $input); // Allow only alphanumeric and spaces
        return trim($input);
    }

    
}



?>