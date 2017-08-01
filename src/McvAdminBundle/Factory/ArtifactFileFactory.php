<?php

use McvAdminBundle\Utils\Validation\KaperFileValidation;
/**
 * Description of ArtifactFactory
 *
 * @author hubert
 */
class ArtifactFileFactory {
    private $inventoryNumber = '';
    private $photoNumber = '';
    private $categorySymbol = '';
    private $extension = '';
    
    public function __construct($filename) {
        $exploded_name = preg_split('/[_.]/', $filename);
        $this->inventoryNumber = $exploded_name[0];
        $this->photoNumber     = $exploded_name[1];
        $this->categorySymbol  = $exploded_name[2];
        $this->extension   = $exploded_name[3];
        }
    public function getDesc(){
        echo 'Jest to obiekt ', $this->inventoryNumber,
             ' o numerze fotografii ', $this->photoNumber,
             ' o kategorii ', $this->categorySymbol,
             ' oraz o rozszerzeniu ',$this->extension;
    }
}
