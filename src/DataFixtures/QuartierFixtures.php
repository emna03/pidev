<?php

namespace App\DataFixtures;

use App\Entity\Quartier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuartierFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $quartierNames = [
            'Centre Ville',
            'La Marsa',
            'Lac 1',
            'Lac 2',
            'El Menzah',
            'El Manar',
            'Ariana',
            'Carthage',
            'Sidi Bou Said',
            'Gammarth'
        ];

        foreach ($quartierNames as $key => $name) {
            $quartier = new Quartier();
            $quartier->setNom($name);
            
            // Reference for later use in LampadaireFixtures
            $this->addReference('quartier_'.$key, $quartier);
            
            $manager->persist($quartier);
        }

        $manager->flush();
    }
}