<?php

declare(strict_types=1);

namespace Septillion\Tests;


use PHPUnit\Framework\TestCase;
use Septillion\Framework\Helper\AssociativeArray;

class AssociativeArrayTest extends TestCase
{
    public function testItContainsAnEmptyArray(): void
    {
        $associativeArray = new AssociativeArray();
        $this->assertIsArray($associativeArray->get());
    }

    public function testItCanSetAnArrayOfItems(): void
    {
        $associativeArray = new AssociativeArray();
        $associativeArray->set([1,2,3]);
        $this->assertContains(2, $associativeArray->get());
    }

    public function testItCanSetItemsByKeyValue(): void
    {
        $associativeArray = new AssociativeArray();
        $associativeArray->setItem('someKey', '1');
        $this->assertArrayHasKey('someKey', $associativeArray->get());
    }

    public function testItCanGetItemByKey(): void
    {
        $associativeArray = new AssociativeArray();
        $associativeArray->setItem('someKey', '1');
        $this->assertSame('1', $associativeArray->getItem('someKey'));
    }
}