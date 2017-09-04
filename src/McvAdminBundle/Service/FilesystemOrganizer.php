<?php

/**
 * Used to find Collection files, manage their names, catalog them ect.
 *
 * @author hubert
 */

namespace McvAdminBundle\Service;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Filesystem\Filesystem;

class FilesystemOrganizer {
    
    public function __construct() {
        
    }
    
    public static function moveToAnotherPlace($originPath, $targetPath)
    {
        $fs = new Filesystem();
        try{
            $fs->rename($originPath, $targetPath);
        } catch (Exception $e){
            throw new Exception('Nie udało sie przenieść pliku');
        }
       
    }
}
 

