<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(1, function () {

            return [
                'first_name' => 'alan',
                'email' => 'alan@alan.fr',
                'password' => 'pass_1234',
                'roles' => ['ROLE_ADMIN']
            ];
        });

        UserFactory::createMany(10, function () {

            return [
                'roles' => ['ROLE_TEACHER']
            ];
        });
    }
}
