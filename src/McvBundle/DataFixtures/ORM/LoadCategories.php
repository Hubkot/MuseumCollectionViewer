<?php

namespace McvBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use McvAdminBundle\Entity\Category;

/**
 * Description of LoadCategories
 *
 * @author hubert
 */
class LoadCategories implements FixtureInterface {
    
    public function load(ObjectManager $manager) {
        $categories = ['II wojna światowa','życie codzienne','panorama','nowożytność','średniowiecze'];
        foreach ($categories as $c){
            $category = new Category();
            $category->setCategoryName($c);
            $manager->persist($category);
        }
        $manager->flush();
        
    }

}
