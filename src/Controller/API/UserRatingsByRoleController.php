<?php

namespace App\Controller\API;

use App\Service\UserRatingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class UserRatingsByRoleController extends AbstractController
{

    public function __construct(private UserRatingService $userRatingService) {}

    #[Route('/api/score_user/{role}', name: 'api_score_user_role')]
    public function all(string $role): JsonResponse
    {
        return $this->json($this->userRatingService->ratingByRole($role));
    }
}
