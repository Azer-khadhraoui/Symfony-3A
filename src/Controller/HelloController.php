<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'app_hello')]
    public function index(): Response
    {
        return $this->render('hello/index.html.twig', [
            'message' => 'Bienvenue dans votre première application Symfony !',
            'name' => 'Développeur',
        ]);
    }

    #[Route('/hello/{name}', name: 'app_hello_name')]
    public function hello(string $name = 'Monde'): Response
    {
        return $this->render('hello/index.html.twig', [
            'message' => "Bonjour $name !",
            'name' => $name,
        ]);
    }
}