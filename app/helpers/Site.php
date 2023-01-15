<?php

class Site
{
    /**
     * Redirect
     */
    public static function redirect(string $location): void
    {
        header('Location: ' . $location);
    }

}