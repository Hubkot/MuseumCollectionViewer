<?php

namespace McvBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use McvBundle\Entity\ArtifactType;

/**
 * Description of LoadArtifactTypes
 *
 * @author hubert
 */
class LoadArtifactTypes implements FixtureInterface{
    
    public function load(ObjectManager $manager) {
        $types = ['pocztówka','numizmaty','broń','ceramika','zastawa'];
        foreach ($types as $t){
            $artifactType = new ArtifactType();
            $artifactType->setTypeName($t);
            $manager->persist($artifactType);
        }
        $manager->flush();
        
    }

}
