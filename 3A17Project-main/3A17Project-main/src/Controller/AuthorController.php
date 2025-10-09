<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AuthorController extends AbstractController
{
    private $authors;
    public function __construct()
    {
        $this->authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpeg', 'username' => ' William Shakespeare', 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );;
    }

    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }


    #[Route('/showAuthor/{name}', name: 'author_show')]
    public function showAuthor($name): Response
    {
        return $this->render('author/show.html.twig', [
            'author_name' => $name,
        ]);
    }


    #[Route('/list', name: 'author_list')]
    public function listAuthors(): Response
    {
        return $this->render('author/list.html.twig', [
            'authors' => $this->authors,
        ]);
    }
    public function getById($id)
    {
        foreach ($this->authors as $auth) {
            if ($auth['id'] == $id) {
                return $auth;
            }
        }
        return null;
    }

    #[Route('/detail/{id}', name: 'author_detail')]
    public function authorDetails($id, AuthorRepository $authorRepository): Response
    {
        $auth = $authorRepository->find($id);
        
        if (!$auth) {
            throw $this->createNotFoundException('Auteur non trouvé');
        }
        
        return $this->render('author/showAuthor.html.twig', [
            "auth" => $auth,
        ]);
    }

    #[Route('/add-authors', name: 'add_authors')]
    public function addAuthors(EntityManagerInterface $entityManager): Response
    {
        // Créer les auteurs
        $author1 = new Author();
        $author1->setUsername('Victor Hugo');
        $author1->setEmail('victor.hugo@gmail.com');

        $author2 = new Author();
        $author2->setUsername('William Shakespeare');
        $author2->setEmail('william.shakespeare@gmail.com');

        $author3 = new Author();
        $author3->setUsername('Taha Hussein');
        $author3->setEmail('taha.hussein@gmail.com');

        // Persister en base de données
        $entityManager->persist($author1);
        $entityManager->persist($author2);
        $entityManager->persist($author3);
        $entityManager->flush();

        return new Response('3 auteurs ont été ajoutés avec succès !');
    }

    #[Route('/authors-db', name: 'authors_from_db')]
    public function listAuthorsFromDb(AuthorRepository $authorRepository): Response
    {
        $authors = $authorRepository->findAll();
        
        return $this->render('author/list.html.twig', [
            'authors' => $authors,
        ]);
    }

    #[Route('/authors', name: 'list_authors')]
    public function showAuthors(AuthorRepository $authorRepository): Response
    {
        $authors = $authorRepository->findAll();
        
        return $this->render('author/list.html.twig', [
            'authors' => $authors,
        ]);
    }
}
