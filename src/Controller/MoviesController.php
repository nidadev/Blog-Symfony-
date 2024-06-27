<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Entity\Movie;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MovieFormType;
use Doctrine\ORM\EntityManagerInterface;
use ProxyManager\Factory\RemoteObject\Adapter\JsonRpc;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private $movieRepository;
    private $em;
    public function __construct(MovieRepository $movieRepository, EntityManagerInterface $em)
    {
       $this->movieRepository = $movieRepository;
       $this->em = $em;
    }
    
   
    /**
     * @Route("/movies/",name="app_movies")
     */
    #[Route('/movies', name : 'movies')]
    public function index() : Response
    {
        
        //dd($movies);
        $movies = $this->movieRepository->findAll();
        return $this->render('movies/index.html.twig',[
            'movies' => $movies
        ]);
    }
     /**
     * create
     *@Route("/movies/create",name="create")
     * @return Response
     */

    #Route[('/movies/create',name:'create')]
    #[Route('/movies/create', name : 'create')]
    public function create(Request $request) : Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieFormType::class, $movie);

        //form request handle
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $newMovie = $form->getData();
            //dd($newMovie);
            $imagePath = $form->get('imagePath')->getData();
            if ($imagePath) {
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                try {
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }
                $newMovie->setImagePath('/uploads/' . $newFileName);
            $this->em->persist($newMovie);
        $this->em->flush();
        return $this->redirectToRoute('/movies');
            } 
        }
        
        return $this->render('/movies/create.html.twig',[
            'form' => $form->createView()
        ]);
        
    }
    
    /**
     * show
     * @Route("/movies/{id}",methods={"GET"},name="show")
     * @param  mixed $movieRepository
     * @return Response
     */
    public function show($id) : Response
    {        
        //dd($movies);
        $movie = $this->movieRepository->find($id);
        //dd($movie);
        return $this->render('movies/show.html.twig',[
            'movie' => $movie
        ]);
    }
    
   
    
    
}
