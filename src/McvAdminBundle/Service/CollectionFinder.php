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
    // Wyszukuje pliki znajdujące się wewnątrz folderu podanego w konstruktorze klasy.
    // Na każdym z plików przeprowadza walidację pod względem zgodności ze standardem Kaper
    public function findAll(){
        $finder = new Finder();    
        $finder->files()->in(($this->finderPath));
        foreach ($finder as $path){
            $filename = $this->getFileName($path);
            $validator = new KaperFileValidation($filename);
            if($validator->validateFileName()){array_push($this->preparedFiles, $validator->prepareFileName());};
        }
        return $this->preparedFiles;
    }
    
    public function getFileName($path){
        $pathExplode = explode('/', $path);
        return $pathExplode[count($pathExplode)-1];
    }
    public function getPreparedFiles(){
        return $this->preparedFiles;
    }
}
    

