<?php

namespace App\Controller;

use App\Repository\GemmesRepository;
use App\Repository\ReliqueRepository;
use App\Repository\SortRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



final class HomeController extends AbstractController  
{
   #[Route("/", name: "home", methods: ["GET", "POST"])]
    public function index(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $marche = $request->request->get('marche');
            $extensions = $request->request->all('extensions') ?? [];
    
            // Stocker les extensions dans la session
            $request->getSession()->set('extensions', $extensions);
           
            // Rediriger vers la route du marché correspondant
            
            return $this->redirectToRoute($marche);

        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
