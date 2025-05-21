<?php
if (!function_exists('display_errors')) {
function display_errors($validation = null, $field = '')
{
    if ($validation && $validation->hasError($field)) {
        return '<small class="text-danger">' . $validation->getError($field) . '</small>';
    }
    return ''; // Return an empty string instead of null
}
}
?>
