<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findRatingByRole(string $role): array
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
             SELECT 
                u.id AS ID, 
                u.first_name,
                u.roles->>0 as Role,
                SUM(r.score) AS total_score
             FROM "user" AS u
             JOIN rating AS r
             ON r.user_rating_id = u.id
             WHERE u.roles->>0 = :role
             GROUP BY u.id
        ';

        $resultSet = $conn->executeQuery($sql, ['role' => $role]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
}
