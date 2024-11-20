<?php

namespace App\DataFixtures;

use App\Factory\ModuleFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
       $modules = ModuleFactory::all();
    }

    public function getDependencies(): array
    {
        return [
            EducationFixtures::class,
        ];
    }

}
