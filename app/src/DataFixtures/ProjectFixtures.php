<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; ++$i) {
            $project = new Project();
            $project->setName('Project '.$i);
            $manager->persist($project);
        }

        $manager->flush();


        return;
    }
}
