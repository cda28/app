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

    private array $courseModules = [
        "Introduction au Full Stack Development" => [
            "Comprendre le développement web",
            "Introduction aux technologies frontend et backend",
            "Installation des outils de développement",
        ],
        "Développement Frontend avec React" => [
            "Introduction à React",
            "Gestion des états avec Redux",
            "Création de composants réutilisables",
        ],
        "Architecture Backend avec Node.js" => [
            "Création d'une API REST",
            "Gestion des bases de données avec Node.js",
            "Sécurité et authentification",
        ],
        "Introduction à la Certification de Compétences en Développement" => [
            "Présentation des compétences attendues",
            "Outils pour le développement efficace",
            "Méthodologies de travail",
        ],
        "Gestion de projets agiles pour développeurs" => [
            "Introduction aux méthodologies agiles",
            "Scrum : rôles et rituels",
            "Kanban et gestion des priorités",
        ],
        "Design patterns et principes SOLID" => [
            "Introduction aux design patterns",
            "Principes SOLID pour un code maintenable",
            "Implémentation pratique des patterns",
        ],
        "Fondamentaux de l'Ingénierie des Systèmes d'Information" => [
            "Concepts clés des systèmes d'information",
            "Gestion des flux d'information",
            "Outils pour la modélisation des systèmes",
        ],
        "Architecture des systèmes d'information" => [
            "Introduction aux architectures d'entreprise",
            "Méthodes de conception des systèmes",
            "Optimisation des performances des systèmes",
        ],
        "Introduction à la Data Science" => [
            "Statistiques descriptives de base",
            "Nettoyage et préparation des données",
            "Visualisation des données",
        ],
        "Big Data et gestion des données volumineuses" => [
            "Introduction au Big Data",
            "Gestion des bases NoSQL",
            "Traitement des données massives avec Hadoop",
        ],
        "Introduction à l'Intelligence Artificielle" => [
            "Histoire et applications de l'IA",
            "Introduction aux réseaux neuronaux",
            "Cas d'utilisation dans différents secteurs",
        ],
        "Apprentissage supervisé et non supervisé" => [
            "Différences entre apprentissage supervisé et non supervisé",
            "Introduction à la régression et à la classification",
            "Clustering et réduction de dimensionnalité",
        ],
    ];

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

        // création des titres 
        $titles = [];
        $courses = [];
        foreach (["FSD", "CDA", "ESI", "DATA", "AIA"] as $title) {
            $titles[] = TitleFactory::createOne(['name' => $title]);

            // création des cours
           
            foreach ($this->courseTitles[$title] as $courseTitle) {
                $c = CourseFactory::createOne(['title' => $courseTitle]);
                // création des modules par cours
                foreach ($this->courseModules[$courseTitle] as $moduleTitle) 
                ModuleFactory::createOne([
                    'title' => $moduleTitle,
                    'courses' => [$c]
                ]);

                $courses[] = $c;
            }
        }

        // // création des écoles 
        foreach (['3WA', 'EM', 'HETIC'] as $name) {
           
            EducationFactory::createOne([
                'name' => $name,
                'titles' => $titles,
                'courses' => $courses
            ]) ;

        }
    }

    // sortir des valeurs aléatoirement d'un tableau 
    private function randomValues(array $data, int $m = 2)
    {
        shuffle($data);

        // on fait ça pour passer la taille du tableau
        $m = min($m, count($data) - 1);

        return array_slice($data, 0, $m);
    }
}
