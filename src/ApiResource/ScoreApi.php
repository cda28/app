<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/score_user/{role}',
            requirements: ['role' => '(student|teacher)'],
            name: 'api_score_user_role',
            description: 'Get the score of a specific user by their ID.',
            normalizationContext: ['groups' => ['user_score:read']]
        )
    ],
    normalizationContext: ['groups' => ['user_score:read']],
)]
class ScoreApi
{
    #[Groups(['user_score:read'])]
    public ?int $ID = null;

    #[Groups(['user_score:read'])]
    public ?string $first_name = null;

    #[Groups(['user_score:read'])]
    public ?string $role = null;

    #[Groups(['user_score:read'])]
    public ?int $total_score = null;

    public function __construct(?int $id = null, ?string $first_name = null, ?string $role = null, ?int $total_score = null)
    {
        $this->ID = $id;
        $this->first_name = $first_name;
        $this->role = $role;
        $this->total_score = $total_score;
    }
}
