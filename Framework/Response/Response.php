<?php

declare(strict_types=1);

namespace Septillion\Framework\Response;


class Response
{
    const CONTENT_TYPE_TEXT_HTML = 'Content-Type';
    private array $_headers;
    private string $_content;
    private string $_statusCode;

    public function __construct(string $content, string $statusCode, array $headers)
    {
        $this->_content = $content;
        $this->_statusCode = $statusCode;
        $this->_headers = $headers;
    }
}