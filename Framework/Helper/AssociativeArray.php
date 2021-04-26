<?php

declare(strict_types=1);

namespace Septillion\Framework\Helper;

class AssociativeArray
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function set(array $array): void
    {
        $this->items = $array;
    }

    public function get(): array
    {
        return $this->items;
    }

    public function getItem(string $key)
    {
        return $this->items[$key] ?? null;
    }

    public function setItem($key, $value): void
    {
        $this->items[$key] = $value;
    }

    /* ==================== Reserved for better implementation ========================= */
    // public function __invoke($data = null){
    //     if( $data === null ){
    //         return $this->get();
    //     } else {
    //         $this->set($data);
    //     }
    // }
}
