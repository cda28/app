<?php

namespace App\Service;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserPresenceService
{

    public function __construct(
        private UserRepository $userRepository,
        private NormalizeService $normalizeService,
    ) {}


    public function presenceByRole(string $role): array
    {
        $roleNormalize = $this->normalizeService->normalize($role);

        // TODO hardcoding export values roles in .env
        if (!array_key_exists($role, $roleNormalize)) 
            throw new BadRequestException("The role '$role' is not valid");

        return $this->userRepository->findPresenceByRole($roleNormalize[$role]);
    }

}
