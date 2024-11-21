<?php

namespace App\DataFixtures;

use App\Enum\Presence;
use App\Factory\ModuleFactory;
use App\Factory\RatingFactory;
use App\Factory\UserFactory;
use App\Factory\UserModulePlanningFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $modules = ModuleFactory::all();

        $users = UserFactory::createMany(60, function ()  {

            return [
                'roles' => ['ROLE_STUDENT'],
                'presence' => rand(1, 3 ) == 1 ? Presence::IN_PERSON :  Presence::ONLINE
            ];
        });

        foreach($users as $user){
            shuffle($modules);

            UserModulePlanningFactory::createOne([
                'user_module' => $user,
                'module' => $modules[0]
            ]);

            RatingFactory::createOne([
                'user_rating' => $user,
                'score' => rand(1, 10),
                'module' => $modules[0]
            ]);
        }

        
    }

    public function getDependencies(): array
    {
        return [
            EducationFixtures::class,
        ];
    }
}
