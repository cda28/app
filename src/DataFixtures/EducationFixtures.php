<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Factory\AddressFactory;
use App\Factory\CourseFactory;
use App\Factory\EducationFactory;
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
            "Gestion de bases de données SQL et NoSQL",
            "Déploiement d'applications Full Stack"
        ],
        "CDA" => [
            "Introduction à la Certification de Compétences en Développement",
            "Gestion de projets agiles pour développeurs",
            "Design patterns et principes SOLID",
            "Tests unitaires et tests d'intégration",
            "Sécurité des applications web"
        ],
        "ESI" => [
            "Fondamentaux de l'Ingénierie des Systèmes d'Information",
            "Architecture des systèmes d'information",
            "Gestion de projets SI et méthodologie Agile",
            "Sécurité des systèmes d'information",
            "Maintenance et évolution des SI"
        ],
        "DATA" => [
            "Introduction à la Data Science",
            "Big Data et gestion des données volumineuses",
            "Analyse de données avec Python",
            "Modélisation et algorithmes de Machine Learning",
            "Data Visualization avec Power BI et Tableau"
        ],
        "AIA" => [
            "Introduction à l'Intelligence Artificielle",
            "Apprentissage supervisé et non supervisé",
            "Deep Learning et réseaux neuronaux",
            "Applications de l'IA dans le secteur privé",
            "Ethique et impact social de l'Intelligence Artificielle"
        ]
    ];

    private array $titles = ["FSD", "CDA", "ESI", "DATA", "AIA"];

    public function load(ObjectManager $manager): void
    {

        foreach (['3WA', 'EM', 'HETIC', 'ARCPLEX'] as $name) {

            $randomKeys = array_rand($this->titles, count($this->titles));

            $randonTitles = [];
            foreach ($randomKeys as $key) {
                $randonTitles[] = $this->titles[$key];
            }

            $titles = [];
            foreach ($randonTitles as $title) {
                $titles[] = TitleFactory::createOne(['name' => $title]);
            }

            // création des courses en fonction des titres

            $courses = [];
            foreach ($randonTitles as $title) {
                foreach ($this->courseTitles[$title] as $courseTitle) {
                   $courses[] = CourseFactory::createOne(['title' => $courseTitle]);
                }
            }

            $education = EducationFactory::createOne([
                'name' => $name,
                'titles' => $titles,
                'address' => AddressFactory::createOne(),
                'courses' => $courses
            ]);

            
        }
    }
}
