<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{

    
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/author/{name}', name: 'app_author_showName')]
    public function showName($name): Response
    {
        return $this->render('author/showName.html.twig', ['name'=> $name]);
    }


    #[Route('/listAuthors', name: 'list_authors')]
    public function listAuthors(): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpeg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpeg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpeg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300)
        );

        // Calculate the total number of books
        $totalBooks = array_sum(array_column($authors, 'nb_books'));

        return $this->render('author/list.html.twig', [
            'authors' => $authors,
            'totalAuthors' => count($authors),
            'totalBooks' => $totalBooks,
        ]);
    }


    #[Route('/authors/details/{id}', name: 'app_author_details')]
    public function authorDetails(int $id): Response
    {
        // Define authors array (same as in listAuthors)
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpeg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpeg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpeg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300)
        );
    
        // Find the author by ID
        $author = array_filter($authors, fn($author) => $author['id'] === $id);
        $author = reset($author); // Get the first matching author
    
        if (!$author) {
            throw $this->createNotFoundException('Auteur non trouvé.');
        }
    
        // Render author details in showAuthor template
        return $this->render('author/showAuthor.html.twig', [
            'author' => $author,
        ]);
    }
    
}
