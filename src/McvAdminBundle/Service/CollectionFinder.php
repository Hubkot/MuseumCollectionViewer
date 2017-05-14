<?php

/**
 * Used to find Collection files, manage their names, catalog them ect.
 *
 * @author hubert
 */

namespace McvAdminBundle\Service;

use McvAdminBundle\Utils\Validation\KaperFileValidation;
use Symfony\Component\Finder\Finder;

class CollectionFinder {
    
    private $finderPath;
    private $preparedFiles = [];
    public function __construct($path) {
        $this->finderPath = $path;
    }
    
    public function findAll(){
        $finder = new Finder();    
        $finder->files()->in(($this->finderPath));
        foreach ($finder as $path){
            $filename = $this->getFileName($path);
            $validator = new KaperFileValidation($filename);
            if($validator->validateFileName()){array_push($this->preparedFiles, $validator->prepareFileName());};
            #echo '<pre>', print_r($path->getRealPath(),true),'</pre>';
            
        }
        return $this->preparedFiles;
    }
    
    public function getFileName($path){
        $pathExplode = explode('/', $path);
        return $pathExplode[count($pathExplode)-1];
    }
}
    

