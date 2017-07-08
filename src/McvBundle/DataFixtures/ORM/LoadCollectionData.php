<?php

/**
 * Description of LoadCollectionData
 *
 * @author https://github.com/Hubkot
 */
namespace McvBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use McvAdminBundle\Entity\Collection;

class LoadCollectionData implements FixtureInterface{
    
    public function load(ObjectManager $manager) {
        for($i=0; $i<10;$i++){
            $collection = new Collection();
            $collection->setName('Kolekcja nr ',$i);
            $collection->setDescription('Jest to opis kolekcji nr ', $i);
            $collection->setStatus(1);
            $manager->persist($collection);
            $manager->flush();
        }
    }

}
