<?php

// Mọi phản hồi của API đều là JSON có trường success
class Response
{
    public static function json(int $status, array $body): never
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    // $extra: các trường bổ sung ngang hàng với data, ví dụ pagination
    public static function success(string $message, mixed $data = null, int $status = 200, array $extra = []): never
    {
        $body = ['success' => true, 'message' => $message];
        if ($data !== null) {
            $body['data'] = $data;
        }
        self::json($status, $body + $extra);
    }

    public static function error(string $message, int $status = 400): never
    {
        self::json($status, ['success' => false, 'message' => $message]);
    }
}
