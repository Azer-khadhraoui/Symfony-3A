<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SecondController extends AbstractController
{
    // #[Route('/second', name: 'app_second')]
    public function index(): Response
    {
        return $this->render('second/index.html.twig', [
            'controller_name' => '3A17',
        ]);
    }


    #[Route('/list/{cour}', name:'second_test')]
    public function test($cour){
         return $this->render('second/test.html.twig',[
            'courName'=> $cour
         ]);

    }
}
