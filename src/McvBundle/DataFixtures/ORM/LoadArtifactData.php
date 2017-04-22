<?php

/**
 * Description of LoadArtifactData
 *
 * @author hubert
 */
namespace McvBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use McvBundle\Entity\Artifact;

class LoadArtifactData implements FixtureInterface{
    
    public function load(ObjectManager $manager) {
        for($i=0; $i<10;$i++){
        
        $artifact = new Artifact();
        $artifact->setInventoryNumber("MHMG-IN-201-$i");
        $manager->persist($artifact);
        }
        
        $manager->flush();
    }

}
