<?php

namespace Server\Request;

class HEADER
{
    public function Add($value = ''): void
    {
        if (empty($value)) {
            return;
        }
        header($value);
    }

    public function JSON_FILE(): void
    {
        header("content-type: application/json");
    }

    public function custom_content_type($value = ''): void
    {
        header('content-type: ' . $value);
    }
}