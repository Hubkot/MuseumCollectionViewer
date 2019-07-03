<?php

namespace McvBundle\Service;

/**
 * Description of DisplayGenerator
 * Manage view of the artifact with param inventoryNumber
 *
 * @author hubert
 */
class DisplayGenerator {
    
    public function __construct($objectToDisplay) {
        $this->displayObject = $objectToDisplay;
    }
}
