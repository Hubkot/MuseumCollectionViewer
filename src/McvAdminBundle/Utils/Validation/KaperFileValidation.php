<?php

/**
 * Checks if file have a right name : KAPER pattern standard.
 * [Inventory-number]_[Photo-number]_[Category-sign].[extension]
 *
 * @author hubert
 */
namespace McvAdminBundle\Utils\Validation;

use Symfony\Component\HttpFoundation\Session\Session;

class KaperFileValidation {
    
    private $filename;
    
    public function __construct($filename){ $this->filename = $filename; }

    public function validateFileName(): bool
    {
        $session = new Session();
        if(count(preg_split('/[_.]/', $this->filename)) == 4){
           return true;
        }
        else{
            $session->getFlashBag()->add('warning', 'Nazwa pliku '.$this->filename .' jest niezgodna ze standardem KAPER [LinkDoStandardu][Zmień_nazwę]');
            return false;
        }
    }
    
    public function prepareFileName()
    {
        $exploded_name = preg_split('/[_.]/', $this->filename);
        $associativeNameArray = [
        'inventory_number' => $exploded_name[0],
        'photo_number'     => $exploded_name[1],
        'category_symbol'  => $exploded_name[2],
        'file_extension'   => $exploded_name[3]
        ];
        
        return $associativeNameArray;
    }
}
