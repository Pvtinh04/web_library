<?php

class Errors
{
    /**
     * Get
     */
    public static function get(string $keyName, array $errors = []): void
    {
        if (!empty($errors[$keyName])) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors[$keyName] as $field => $error) : ?>
                    <?= $error; ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif;
    }
}