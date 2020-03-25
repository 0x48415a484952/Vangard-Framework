<?php

declare(strict_types=1);

namespace Septillion\Framework\Response;

class Response
{
    public const HTTP_OK = 200;
    public const HTTP_CREATED = 201;
    public const HTTP_ACCEPTED = 202;
    public const HTTP_NO_CONTENT = 204;
    public const HTTP_MOVED_PERMANENTLY = 301;
    public const HTTP_SEE_OTHER = 303;
    public const HTTP_NOT_MODIFIED = 304;
    public const HTTP_TEMPORARY_REDIRECT = 307;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_UNAUTHORIZED = 401;
    public const HTTP_FORBIDDEN = 403;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_METHOD_NOT_ALLOWED = 405;
    public const HTTP_NOT_ACCEPTABLE = 406;
    public const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;
    public const HTTP_NOT_IMPLEMENTED = 501;

    private string $_content;
    private int $_statusCode;

    public function __construct(?string $content, ?int $status = null)
    {
        $this->_content = $content;
        $this->_statusCode = $status ?? self::HTTP_OK;
    }

    public function send(?array $headers = null): void
    {
        foreach ($headers as $key => $value) {
            switch ($key) {
                //CT stands for Content-Type
                case 'CT':
                    switch ($value) {
                        case 'text/h':
                            header('Content-Type: text/html');
                            break;
                        case 'text/p':
                            header('Content-Type: text/plain');
                            break;
                        case 'json':
                            header('Content-Type: application/json');
                            $this->_content = json_encode($this->_content, JSON_THROW_ON_ERROR, 512);
                            break;
                    }
                break;
                //XBP stands for X-Powered-By
                case 'XBP':
                    switch ($value) {
                        case 'hazhir':
                            header('X-Powered-By: Hazhir');
                            break;

                    }
                break;
            }
        }
        http_response_code($this->_statusCode);
        echo $this->_content;
    }

}
