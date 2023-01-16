<?php

class File
{
    /**
     * Delete
     */
    public static function delete(string $filePath): void
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    /**
     * Upload
     */
    public static function upload(array $file): ?string
    {
        if ($file['error'] !== 0) {
            return null;
        }
        $temp = explode('.', $file['name']);
        $uploadDir = 'public/uploads/';
        $newFileName = Time::get() . '.' . end($temp);
        $filePath = $uploadDir . $newFileName;
        return move_uploaded_file($file['tmp_name'], $filePath) ? $filePath : null;
    }

    /**
     * Validate
     */
    public static function validate(array $file, string $message, array $mimeTypes, array $errors = []): array
    {
        if (!$file) {
            $errors['avatar'] = $message;
        }
        if (isset($file['error']) && $file['error'] === 0) {
            if (!in_array(mime_content_type($file['tmp_name']), $mimeTypes)) {
                $errors['avatar'] = $message;
            }
        }

        return $errors;
    }
}