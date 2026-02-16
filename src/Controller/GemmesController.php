<?php

namespace App\Controller;

use App\Repository\GemmesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GemmesController extends AbstractController
{
    // repertoire des gemmes
    #[Route('/gemme', name: 'gemme.index')]
    public function index(Request $request, GemmesRepository $gemmesR): Response
    {   
        $gemmes=$gemmesR->findAll();
      
        return $this-> render('gemme/index.html.twig',[
            'gemmes' => $gemmes
        ]);
    }

    // page pour une gemme     
    #[Route('/gemme/{id}', name: 'gemme.show', requirements: ['id' => '\d+'])]
    public function show(Request $request,int $id, GemmesRepository $gemmesR): Response
    {   
        $gemme = $gemmesR->find($id);
        return $this-> render('gemme/show.html.twig',[
            'gemme'=>$gemme
        ]);
    }

}