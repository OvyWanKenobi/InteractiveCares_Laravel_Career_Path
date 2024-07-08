<?php

function sanitize(string $data): string
{
    return htmlspecialchars(stripcslashes(trim($data)));
}


function flash($key, $message = null)
{

    if ($message) {
        $_SESSION['flash'][$key] = $message;
    } elseif (isset($_SESSION['flash'][$key])) {
        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $message;
    }
}
