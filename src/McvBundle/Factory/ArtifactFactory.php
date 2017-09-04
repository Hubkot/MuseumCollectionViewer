<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArtifactFactory
 *
 * @author hubert
 */
class ArtifactFactory implements ArtifactInterface {
    
    private $inventoryNumber;

    public function __construct($inventoryNumber) {
        $this->inventoryNumber = $inventoryNumber;
    }
    public function create(){
        $artifactM = new McvAdminBundle\Entity\Artifact();
      
        //Tabele do połączenia z numerem
        //najpierw GetInNumbert - ID!
      
        // 	artifact_description
        // 	artifact_files
        //	artifact_type
        //	artifact_type
        // 	category
        // 	collection
        // 	indirect_collection_artifact
    }
     
    public function createInventoryCard() {
    //return array of info    
    }

}
