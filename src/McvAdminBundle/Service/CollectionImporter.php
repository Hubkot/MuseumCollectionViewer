<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace McvAdminBundle\Service;

use McvAdminBundle\Entity\Artifact;
use McvAdminBundle\Entity\ArtifactFiles;

/**
 * Description of CollectionImporter
 *
 * @author hubert
 */
class CollectionImporter {
    
    private $collection = [];
    private $importBag = [];

//TODO - CHWILOWO NIEUŻYWANA
    public function __construct($collection) {
        $this->collection = $collection;
    }
    
    public function getCollection(){
        return $this->collection;
    }
    
    public function getImportBag(){
        return $this->importBag;
    }

    public function getAllFilePath(){
        foreach ($this->collection as $f){
            array_push($this->importBag, $this->joinFilePath($f));
        }
        return $this->importBag;
    }
    
    public function getInventoryNumber($collectionItem){
        return $collectionItem['inventory_number'];
    }
    
    public function joinFilePath($arrayItem){
        $filePath = $arrayItem['inventory_number']
                .'_'.$arrayItem['photo_number']
                .'_'.$arrayItem['category_symbol']
                .'.'.$arrayItem['file_extension'];
        return strtolower($filePath);
    }
    
}
