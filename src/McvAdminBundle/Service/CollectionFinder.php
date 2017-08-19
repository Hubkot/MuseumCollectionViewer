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
    // TODO: dodać możliwość wyboru validatora. Dzięki temu skrypt można będzie wykorzystać w róznoraki sposób.
    // findAll(Validator $validator)
    public function findAll(){
        $finder = new Finder();    
        $finder->files()->in($this->finderPath);
        foreach ($finder as $path){
            $path = $this->getPublicPath($path);
            $filename = $this->getFileName($path);
            $validator = new KaperFileValidation($filename, $path);
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
    
    //TODO : Złe odwołanie od ścieżki - muszę doczytać jak prawidłowo odwoływać się do publicznego katalogu
    public function getPublicPath($path)
    {
        $publicPath = explode('/web/', $path);
        return $publicPath[1];
    }
}
    

