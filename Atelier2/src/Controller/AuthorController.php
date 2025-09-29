<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author/{name}", name="show_author")
     */
    public function showAuthor(string $name): Response
    {
        return $this->render('show.html.twig', [
            'name' => $name,
        ]);
    }

    /**
     * @Route("/authors", name="list_authors")
     */
    public function listAuthors(): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.webp','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.webp','username' => ' William Shakespeare', 'email' => ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpeg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );

        // Calculer le nombre total de livres
        $totalBooks = 0;
        foreach ($authors as $author) {
            $totalBooks += $author['nb_books'];
        }

        return $this->render('list.html.twig', [
            'authors' => $authors,
            'totalBooks' => $totalBooks,
        ]);
    }

    /**
     * @Route("/author/details/{id}", name="author_details")
     */
    public function authorDetails(int $id): Response
    {
        $authors = array(
            1 => array('id' => 1, 'picture' => '/images/Victor-Hugo.webp','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
            2 => array('id' => 2, 'picture' => '/images/william-shakespeare.webp','username' => ' William Shakespeare', 'email' => ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            3 => array('id' => 3, 'picture' => '/images/Taha_Hussein.jpeg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );

        if (!isset($authors[$id])) {
            throw $this->createNotFoundException('Auteur non trouvé');
        }

        return $this->render('showAuthor.html.twig', [
            'author' => $authors[$id],
        ]);
    }
}