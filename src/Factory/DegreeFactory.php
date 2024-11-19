<?php

namespace App\Factory;

use App\Entity\Degree;
use App\Enum\Diploma;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Degree>
 */
final class DegreeFactory extends PersistentProxyObjectFactory
{

    private array $degrees = [
        'NONE' => [
            'name' => 'No Formal Education',
            'speciality' => 'General Education'
        ],
        'HIGH_SCHOOL' => [
            'name' => 'High School Diploma or Equivalent',
            'speciality' => 'General Studies'
        ],
        'ASSOCIATE' => [
            'name' => 'Associate Degree (e.g., AA, AS)',
            'speciality' => 'Business Administration'
        ],
        'BACHELOR' => [
            'name' => 'Bachelor’s Degree (e.g., BA, BS, BEng)',
            'speciality' => 'Computer Science'
        ],
        'MASTER' => [
            'name' => 'Master’s Degree (e.g., MA, MS, MBA)',
            'speciality' => 'Data Science'
        ],
        'DOCTORATE' => [
            'name' => 'Doctorate Degree (e.g., PhD, EdD)',
            'speciality' => 'Physics'
        ],
        'CERTIFICATE' => [
            'name' => 'Professional Certification or Certificate',
            'speciality' => 'Project Management'
        ],
        'DIPLOMA' => [
            'name' => 'Advanced Diploma or Specialized Diploma',
            'speciality' => 'Graphic Design'
        ],
        'PROFESSIONAL' => [
            'name' => 'Professional Degree (e.g., JD, PharmD)',
            'speciality' => 'Law'
        ]
    ];

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Degree::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {

        $degrees = self::faker()->shuffleArray($this->degrees);
        $keys = array_keys($degrees);
        return [
            'name' => $degrees[$keys[0]]['name'],
            'speciality' => $degrees[$keys[0]]['speciality'],
            'diploma' => Diploma::BACHELOR
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Degree $degree): void {})
        ;
    }
}
