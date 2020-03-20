<?php 

declare(strict_types=1);

namespace Septillion\Framework\Request;

class AssociativeArray
{
    private array $_items = [];

    public function __construct() {
        
    }

    public function set(array $array) {
        $this->_items = $array;
    }

    public function get() {
        return $this->_items;
    }
    
    public function addItem(string $key, string $value) {
        if ($key) {
            $this->_items[$key] = $value;
        }
    }

    public function getItem(string $key) {
        return key_exists($key, $this->_items) ? $this->_items[$key] : null;
    }

    /* ==================== Reserved for better implementation ========================= */
    // public function __invoke($data = null){
    //     if( $data === null ){
    //         return $this->get();
    //     } else {
    //         $this->set($data);
    //     }
    // }

    public function __get(string $key){
        return $this->getItem($key);
    }

    public function __set(string $key, $value){
        $this->addItem($key, $value);
    }
}