<?php

namespace Server;

class HEADER
{
    public function Add($value = ''): void
    {
        if (empty($value)) {
            return;
        }
        header($value);
    }

    public function httpVersion($e=0){
        switch ($e){
            case 0:
                return "HTTP/1.1";
            case 1:
                return "HTTP/2";
            case 2:
                return "HTTP/3";
        }
    }

    public function JSON_FILE(): void
    {
        header("content-type: application/json");
    }

    public function custom_content_type($value = ''): void
    {
        header('Content-Type: ' . $value);
    }

    public function setHttpHeaders($statusCode, $httpversion=0, $contentType=null): void
    {
        $statusMessage = $this->getHttpStatusMessage($statusCode);

        header($this->httpVersion($httpversion) . " " . $statusCode . " " . $statusMessage);
        if(!empty($contentType)){
            $this->custom_content_type($contentType);
        }
    }

    public function getHttpStatusMessage($statusCode): string
    {
        if ($statusCode === null) return "";
        $httpStatus = array(
            // Informational
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',

            // Success
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',
            208 => 'Already Reported',
            226 => 'IM Used',

            // Redirection
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            308 => 'Permanent Redirect',

            // Client Error
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            418 => 'I\'m a teapot',
            421 => 'Misdirected Request',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            425 => 'Too Early',
            426 => 'Upgrade Required',
            428 => 'Precondition Required',
            429 => 'Too Many Requests',
            431 => 'Request Header Fields Too Large',
            451 => 'Unavailable For Legal Reasons',

            // Server Error
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            508 => 'Loop Detected',
            510 => 'Not Extended',
            511 => 'Network Authentication Required');
        return @($httpStatus[$statusCode]) ?: $httpStatus[500];
    }
}
