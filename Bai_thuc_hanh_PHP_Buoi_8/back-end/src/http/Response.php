<?php

// Mọi phản hồi của API đều là JSON có trường success
class Response
{
    public static function json(int $status, array $body): never
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($body, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function success(string $message, mixed $data = null, int $status = 200): never
    {
        $body = ['success' => true, 'message' => $message];
        if ($data !== null) {
            $body['data'] = $data;
        }
        self::json($status, $body);
    }

    public static function error(string $message, int $status = 400): never
    {
        self::json($status, ['success' => false, 'message' => $message]);
    }
}
