<?php

namespace App\Controller;

use App\Repository\ReliqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReliqueController extends AbstractController
{
  
     // repertoire des reliques
    #[Route('/relique', name: 'relique.index')]
    public function index(Request $request, ReliqueRepository $reliqueR): Response
    {   
        $reliques=$reliqueR->findAll();
      
        return $this-> render('relique/index.html.twig',[
            'reliques' => $reliques
        ]);
    }

    // page pour une relique     
    #[Route('/relique/{id}', name: 'relique.show', requirements: ['id' => '\d+'])]
    public function show(Request $request,int $id, ReliqueRepository $reliqueR): Response
    {   
        $relique = $reliqueR->find($id);
        return $this-> render('relique/show.html.twig',[
            'relique'=>$relique
        ]);
    }
}
