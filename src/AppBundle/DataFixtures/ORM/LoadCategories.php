<?php

namespace AppoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategories implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $categories = array(
            "Expression",
            "Vocabulaire",
            "Sacre",
            "Deformation"
        );
        
        foreach ($categories as $catName) {
            $categorie = new \AppBundle\Entity\Categorie();
            $categorie->setNom($catName);
            $manager->persist($categorie);
        }
        
        $manager->flush(); 
    }
}