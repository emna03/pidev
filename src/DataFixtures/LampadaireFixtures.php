<?php

namespace App\DataFixtures;

use App\Entity\Lampadaire;
use App\Entity\Quartier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LampadaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Get all existing quartiers
        $quartiers = $manager->getRepository(Quartier::class)->findAll();
        
        if (empty($quartiers)) {
            throw new \RuntimeException('No quartiers found. Please load QuartierFixtures first.');
        }

        $locations = [
            'Rue principale', 'Avenue centrale', 'Boulevard nord', 
            'Place du marché', 'Rue des artisans', 'Avenue des sports',
            'Route du parc', 'Allée des roses', 'Boulevard sud',
            'Place de la mairie'
        ];

        // Create 50 lampadaires
        for ($i = 0; $i < 50; $i++) {
            $lampadaire = new Lampadaire();
            
            // Set random location with number
            $baseLocation = $locations[array_rand($locations)];
            $lampadaire->setLocalisation($baseLocation . ' ' . ($i + 1));
            
            // Random state (true/false)
            $lampadaire->setEtat((bool)random_int(0, 1));
            
            // Random consumption between 10 and 100 kWh
            $lampadaire->setConsommation(random_int(10, 100) + round(random_int(0, 100) / 100, 2));
            
            // Random installation date between 2 years ago and today
            $date = new \DateTime();
            $date->modify('-' . random_int(0, 730) . ' days'); // 730 days = 2 years
            $lampadaire->setDateInstallation($date);
            
            // Assign to random quartier
            $randomQuartier = $quartiers[array_rand($quartiers)];
            $lampadaire->setQuartier($randomQuartier);
            
            // Update quartier's total consumption
            $randomQuartier->setConsomTot(
                $randomQuartier->getConsomTot() + $lampadaire->getConsommation()
            );
            
            // Update quartier's lampadaire count
            $randomQuartier->setLampadaireCount(
                $randomQuartier->getLampadaireCount() + 1
            );
            
            $manager->persist($lampadaire);
        }

        $manager->flush();
    }
}