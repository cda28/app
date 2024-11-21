<?php

namespace App\Service;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserRatingService
{

    public function __construct(
        private UserRepository $userRepository
    ) {}


    public function ratingByRole(string $role): array
    {
        // TODO hardcoding export values roles in .env
        if (!in_array($role, ['student', 'admin', 'teacher'], true)) 
            throw new BadRequestException("The role '$role' is not valid");

        $role = $this->normalizeRole($role);

        return $this->userRepository->findRatingByRole($role);
    }

    private function normalizeRole(string $role): string
    {
        // TODO hardcoding export values roles in .env
        $roleMap = [
            'student' => 'ROLE_STUDENT',
            'admin' => 'ROLE_ADMIN',
            'teacher' => 'ROLE_TEACHER',
        ];

        return $roleMap[$role] ?? $role; 
    }
}
