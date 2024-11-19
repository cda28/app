<?php

namespace App\Factory;

use App\Entity\User;
use App\Enum\Presence;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<User>
 */
final class UserFactory extends PersistentProxyObjectFactory
{
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
        return User::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'first_name' => self::faker()->firstName(),
            'last_name' => self::faker()->lastName(),
            'email' => self::faker()->unique()->email(),
            'roles' => [self::faker()->shuffleArray(['ROLE_USER', 'ROLE_TEACHER'])[0]],
            'presence' => self::faker()->shuffleArray([Presence::BUSY, Presence::IN_PERSON, Presence::OFFLINE])[0],
            'dregrees' => DegreeFactory::createMany(rand(1, 3)) // degrees c'est le nom de la relation dans Doctrine
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(User $user): void {})
        ;
    }
}
