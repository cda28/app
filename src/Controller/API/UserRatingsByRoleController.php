<?php

namespace App\Controller\API;

use App\Repository\UserRepository;
use App\Service\UserPresenceService;
use App\Service\UserRatingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class UserRatingsByRoleController extends AbstractController
{

    public function __construct(
        private UserRatingService $userRatingService,
        private UserRepository $userRepository,
        private UserPresenceService $userPresenceService
    ) {}

    #[Route('/api/score_user/{role}', name: 'api_score_user_role')]
    public function rating(string $role): JsonResponse
    {
        return $this->json($this->userRatingService->ratingByRole($role));
    }

    #[Route('/api/presence_user/{role}', name: 'api_presence_user_role')]
    public function presence(string $role): JsonResponse
    {
        return $this->json($this->userPresenceService->presenceByRole($role));
    }
}
