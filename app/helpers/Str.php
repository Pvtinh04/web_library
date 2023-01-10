<?php

class Str
{
    /**
     * Clean
     */
    public static function clean(string $value, bool $tags = true): string
    {
        $value = trim($value);
        $value = stripslashes($value);

        if ($tags === true) {
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
        }

        return $value;
    }

    /**
     * Validate
     */
    public static function validate(
        string $value,
        string $key,
        array $messages,
        bool $required = false,
        int $length = 0,
        array $errors = []
    ): array {
        if ($required === true && empty($value)) {
            $errors[$key][] = $messages['required'] ?? 'Required field is empty!';
        }

        if ($length !== 0 && mb_strlen($value, 'utf-8') > $length) {
            $errors[$key][] =  $messages['length'] ?? 'String is too large!';
        }
        return $errors;
    }
}