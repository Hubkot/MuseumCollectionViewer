<?php

/**
 * Used to find Collection files, manage their names, catalog them ect.
 *
 * @author hubert
 */

namespace McvAdminBundle\Service;

use Symfony\Component\Filesystem\Filesystem;

class FilesystemOrganizer {
    
    private $fileinfo;
    
    public function __construct(array $fileinfo) {
        $this->fileinfo = $fileinfo;
    }
    
    public function moveToSharedFolder()
    {
    }
}
 

