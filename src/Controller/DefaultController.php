<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'character_index', methods: ['GET'])]
    public function sortable(EntityManagerInterface $entityManager): Response
    {
        return $this->render('default/sortable.html.twig', [
            'user' => $entityManager->getRepository(User::class)->findAll()[0]
        ]);
    }
}
