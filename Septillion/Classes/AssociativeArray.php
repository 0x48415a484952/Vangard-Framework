<?php 

namespace Septillion\Classes;

class AssociativeArray {
    private $_items = [];

    public function __construct() {
        
    }

    public function set(array $array){
        $this->_items = $array;
    }

    public function get(){
        return $this->_items;
    }
    
    public function addItem($key, $value){
        if( $key ){
            $this->_items[$key] = $value;
        }
    }

    public function getItem($key){
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