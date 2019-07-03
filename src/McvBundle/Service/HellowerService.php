<?php

/**
 * Description of HellowerService
 *
 * @author hubert
 */
namespace McvBundle\Service;

class HellowerService {
    
    public function __construct($greeting) {
        $this->greeting = $greeting;
    }
    public function greet($name){
       return $this->greeting . ' ' . $name; 
    }
}
