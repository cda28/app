<?php

namespace App\DataFixtures;

use App\Factory\ModuleFactory;
use App\Factory\RatingFactory;
use App\Factory\UserFactory;
use App\Factory\UserModulePlanningFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TeacherFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
      
        $modules = ModuleFactory::all();

        $teachers = UserFactory::createMany(10, function () {

            return [
                'roles' => ['ROLE_TEACHER']
            ];
        });

        foreach($teachers as $teacher){
            shuffle($modules);

            UserModulePlanningFactory::createOne([
                'user_module' => $teacher,
                'module' => $modules[0]
            ]);

            RatingFactory::createOne([
                'user_rating' => $teacher,
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
