<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Factory\AddressFactory;
use App\Factory\CourseFactory;
use App\Factory\EducationFactory;
use App\Factory\ModuleFactory;
use App\Factory\TitleFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EducationFixtures extends Fixture
{

    private array $courseTitles = [
        "FSD" => [
            "Introduction au Full Stack Development",
            "Développement Frontend avec React",
            "Architecture Backend avec Node.js",
        ],
        "CDA" => [
            "Introduction à la Certification de Compétences en Développement",
            "Gestion de projets agiles pour développeurs",
            "Design patterns et principes SOLID",
        ],
        "ESI" => [
            "Fondamentaux de l'Ingénierie des Systèmes d'Information",
            "Architecture des systèmes d'information",
        ],
        "DATA" => [
            "Introduction à la Data Science",
            "Big Data et gestion des données volumineuses",
        ],
        "AIA" => [
            "Introduction à l'Intelligence Artificielle",
            "Apprentissage supervisé et non supervisé",
        ]
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (['3WA', 'EM', 'HETIC'] as $name) {

            [$titles, $courses] = [[], []];
            foreach ($this->randomValues(["FSD", "CDA", "ESI", "DATA"]) as $t) {
                $titles[] = TitleFactory::createOne(['name' => $t]);
                foreach ($this->courseTitles[$t] as $courseTitle) {
                    $courses[] = CourseFactory::createOne(['title' => $courseTitle]);
                }
            }

            EducationFactory::createOne([
                'name' => $name,
                'titles' => $titles,
                'address' => AddressFactory::createOne(),
                'courses' => $courses
            ]);

            foreach (CourseFactory::all() as $course) {

                ModuleFactory::createMany(rand(1, 2), function () use ($course) {

                    return [
                        'courses' => [$course]
                    ];
                });
            }
        }
    }

    private function randomValues(array $data, int $m = 2)
    {

        $randomKeys = array_rand($data, $m);
        $alea = [];
        foreach ($randomKeys as $key)
            $alea[] = $data[$key];

        return $alea;
    }
}
