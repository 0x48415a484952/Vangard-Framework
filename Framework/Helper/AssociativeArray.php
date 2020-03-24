<?php 

declare(strict_types=1);

namespace Septillion\Framework\Helper;

class AssociativeArray
{
    private array $_items = [];

    public function __construct()
    {
        
    }

    public function set(array $array): void
    {
        $this->_items = $array;
    }

    public function get(): array
    {
        return $this->_items;
    }

    public function getItem(string $key)
    {
        return $this->_items[$key] ?? null;
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