<?php

/**
 * Description of LoadArtifactData
 *
 * @author hubert
 */
namespace McvBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use McvAdminBundle\Entity\Artifact;
use McvAdminBundle\Entity\ArtifactDescription;

class LoadArtifactData implements FixtureInterface{
    
    public function load(ObjectManager $manager) {
        for($i=0; $i<10;$i++){
            $artifact = new Artifact();
            $artifact->setInventoryNumber("ML-IN-201-$i");
            $manager->persist($artifact);
            $description = new ArtifactDescription();
            $manager->flush();
            
            $description->setAuthor(1);
            $description->setArtifactId($artifact->getId());
            $description->setCopyrights('Muzem Lotnictwa');
            $description->setTitle('Opis testowy dotyczy zabytku nr: '.$description->getArtifactId());
            $manager->persist($description);
            $manager->flush();
        }
    }

}
