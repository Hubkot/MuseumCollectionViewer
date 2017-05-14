<?php

/**
 * Checks if file have a right name : KAPER pattern standard.
 * [Inventory-number]_[Photo-number]_[Category-sign].[extension]
 *
 * @author hubert
 */
namespace McvAdminBundle\Utils\Validation;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;


class KaperFileValidation {
    private $filename;
    
    public function __construct($filename){ $this->filename = $filename; }

    public function prepareFileName()
    {
        $exploded_name = preg_split('/[_.]/', $this->filename);
        $associativeNameArray = [
        'inventory_number' => $exploded_name[0],
        'photo_number'     => $exploded_name[1],
        'category_sign'    => $exploded_name[2],
        'file_extension'   => $exploded_name[3]
        ];
        
        return $associativeNameArray;
    }
    public function validateFileName(): bool
    {
        if(count(preg_split('/[_.]/', $this->filename)) == 4){
           return true;
        }
        else{
            $FlashBag = new FlashBag();
            $FlashBag->add('notice', 'Nazwa pliku ',$this->filename ,' jest niezgodna ze standardem KAPER [Zajrzyj do : POMOC]');
            return false;
        }
    }
}
