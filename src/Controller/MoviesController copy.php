<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Entity\Movie;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use ProxyManager\Factory\RemoteObject\Adapter\JsonRpc;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
            $this->em = $em;   
    }
    /**
     * @Route("/movies/",name="app_movies")
     */
    #[Route('/movies', name : 'movies')]
    public function index(MovieRepository $movieRepository) : Response
    {
        /*return $this->json([
            'message' => $name,
            'path' => 'src/Controller/MoviesController.php',
        ]);*/
       /* $movies = ['abc', 'def'];
        return $this->render('index.html.twig', array('movies' => $movies));*/

        $movies = $movieRepository->findAll();
        //dd($movies);
        return $this->render('asset.html.twig');
    }
    
    /**
     * second
     *
     * @param  mixed $em
     * @return Response
     * @Route("/second/",name="second")
     */
    public function second(EntityManagerInterface $em) : Response
    {
        /*return $this->json([
            'message' => $name,
            'path' => 'src/Controller/MoviesController.php',
        ]);*/
       /* $movies = ['abc', 'def'];
        return $this->render('index.html.twig', array('movies' => $movies));*/

       $repository = $em->getRepository(Movie::class);

       $movies = $repository->findAll();
        //dd($movies);
        return $this->render('index.html.twig');
    }

    /**
     * second
     *
     * @param  mixed $em
     * @return Response
     * @Route("/construct/",name="construct")
     */
    public function third() : Response
    {
        /*return $this->json([
            'message' => $name,
            'path' => 'src/Controller/MoviesController.php',
        ]);*/
       /* $movies = ['abc', 'def'];
        return $this->render('index.html.twig', array('movies' => $movies));*/

       $repository = $this->em->getRepository(Movie::class);

       $movies = $repository->findAll();
        dd($movies);
        return $this->render('index.html.twig');
    }
}
