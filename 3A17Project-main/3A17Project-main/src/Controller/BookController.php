<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Author;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/book')]
final class BookController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em) {}

    #[Route('/', name: 'book_index')]
    public function index(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();
        $publishedCount = $bookRepository->count(['published' => true]);
        $unpublishedCount = $bookRepository->count(['published' => false]);

        return $this->render('book/index.html.twig', [
            'books' => $books,
            'publishedCount' => $publishedCount,
            'unpublishedCount' => $unpublishedCount,
        ]);
    }

    #[Route('/new', name: 'book_new')]
    public function new(Request $request): Response
    {
        $book = new Book();
        $book->setPublished(true); // default published = true

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // increment author's nbBooks
            $author = $book->getAuthor();
            if ($author) {
                $author->setNbBooks(($author->getNbBooks() ?? 0) + 1);
            }

            $this->em->persist($book);
            $this->em->flush();

            $this->addFlash('success', 'Book created successfully!');
            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'book_edit')]
    public function edit(Request $request, Book $book): Response
    {
        // Keep track of previous author to adjust counters if reassigned
        $oldAuthor = $book->getAuthor();

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // If author changed, decrement old and increment new
            $newAuthor = $book->getAuthor();
            if ($oldAuthor && $oldAuthor !== $newAuthor) {
                $oldAuthor->setNbBooks(max(0, ($oldAuthor->getNbBooks() ?? 0) - 1));
            }
            if ($newAuthor && $oldAuthor !== $newAuthor) {
                $newAuthor->setNbBooks(($newAuthor->getNbBooks() ?? 0) + 1);
            }

            $this->em->flush();
            $this->addFlash('success', 'Book updated successfully!');
            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/edit.html.twig', [
            'form' => $form->createView(),
            'book' => $book,
        ]);
    }

    #[Route('/delete/{id}', name: 'book_delete')]
    public function delete(Book $book): Response
    {
        // decrement author's nbBooks
        $author = $book->getAuthor();
        if ($author) {
            $author->setNbBooks(max(0, ($author->getNbBooks() ?? 0) - 1));
        }

        $this->em->remove($book);
        $this->em->flush();

        $this->addFlash('success', 'Book deleted successfully!');
        return $this->redirectToRoute('book_index');
    }

    #[Route('/show/{id}', name: 'book_show')]
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/purge-authors-without-books', name: 'authors_purge_without_books')]
    public function purgeAuthorsWithoutBooks(AuthorRepository $authorRepository): Response
    {
        $authors = $authorRepository->findBy(['nbBooks' => 0]);
        foreach ($authors as $author) {
            $this->em->remove($author);
        }
        $this->em->flush();

        $this->addFlash('success', 'Authors without books removed!');
        return $this->redirectToRoute('book_index');
    }

    #[Route('/published', name: 'book_published')]
    public function listPublished(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findBy(['published' => true]);
        $publishedCount = $bookRepository->count(['published' => true]);
        $unpublishedCount = $bookRepository->count(['published' => false]);

        return $this->render('book/published.html.twig', [
            'books' => $books,
            'publishedCount' => $publishedCount,
            'unpublishedCount' => $unpublishedCount,
        ]);
    }
}
