<?php

declare(strict_types=1);

namespace Septillion\Tests;


use PHPUnit\Framework\TestCase;
use Septillion\Framework\Request\Request;

class RequestTest extends TestCase
{
    protected Request $request;

    protected function setUp(): void
    {
        $_SERVER['REQUEST_URI'] = '/septillion/hazhir/ahmadzadeh';
        $this->request = Request::getInstance();
    }

    public function testItCanGetRequestInstance(): void
    {

        $this->assertInstanceOf(Request::class, $this->request);
    }

    public function testItHasUriAttribute(): void
    {
        $this->assertObjectHasAttribute('uri', $this->request);
    }

    public function testItHasUriPartsAttribute(): void
    {
        $this->assertObjectHasAttribute('uriParts', $this->request);
    }

    public function testItHasQueryAttribute(): void
    {
        $this->assertObjectHasAttribute('query', $this->request);
    }

    public function testItHasBodyAttribute(): void
    {
        $this->assertObjectHasAttribute('body', $this->request);
    }

    public function testItHasParamsAttribute(): void
    {
        $this->assertObjectHasAttribute('params', $this->request);
    }

    public function testItCanSetPostBodyParams(): void
    {
        $_POST['septillion'] = 'hazhir';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        Request::setPostBodyParams();
        $this->assertSame('hazhir', $this->request->body->getItem('septillion'));
    }


}