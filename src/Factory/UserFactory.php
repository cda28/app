<?php

namespace App\Factory;

use App\Entity\User;
use App\Enum\Presence;
use App\Enum\Status;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends PersistentProxyObjectFactory<User>
 */
final class UserFactory extends PersistentProxyObjectFactory
{
    private $passwordHasher;
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();

        $this->passwordHasher = $passwordHasher;
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
            'password' => 'pass_1234',
            'last_name' => self::faker()->lastName(),
            'email' => self::faker()->unique()->email(),
            'roles' => [self::faker()->shuffleArray(['ROLE_STUDENT', 'ROLE_TEACHER'])[0]],
            'presence' => self::faker()->shuffleArray([Presence::BUSY, Presence::IN_PERSON, Presence::OFFLINE])[0],
            'dregrees' => DegreeFactory::createMany(rand(1, 3)) ,// degrees c'est le nom de la relation dans Doctrine
            'user_infos' => UserDetailFactory::createMany(rand(1,2)),
            'address' => AddressFactory::createOne(),
            'status' => Status::PUBLISHED
        ];
    }


    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this->afterInstantiate(function (User $user): void {
            // Hache le mot de passe après l'instanciation
            $user->setPassword(
                $this->passwordHasher->hashPassword($user, $user->getPassword())
            );
        });
    }
}
