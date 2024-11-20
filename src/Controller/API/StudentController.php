<?php

namespace App\Controller\API;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class StudentController extends AbstractController
{
    #[Route('/api/students', name: 'app_api_student')]
    public function index(EntityManagerInterface $em): JsonResponse
    {

        $students = $em->getRepository(User::class)->findRatingByRole('ROLE_STUDENT');

       dd($students);

        return $this->json($students);
    }
}
