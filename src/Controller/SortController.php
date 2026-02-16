<?php

namespace App\Controller;

use App\Repository\SortRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SortController extends AbstractController
{
        // repertoire des sorts
    #[Route('/sort', name: 'sort.index')]
    public function index(Request $request, SortRepository $sortR): Response
    {   
        $sorts=$sortR->findAll();
      
        return $this-> render('sort/index.html.twig',[
            'sorts' => $sorts
        ]);
    }

    // page pour une sort     
    #[Route('/sort/{id}', name: 'sort.show', requirements: ['id' => '\d+'])]
    public function show(Request $request,int $id, SortRepository $sortR): Response
    {   
        $sort = $sortR->find($id);
        return $this-> render('sort/show.html.twig',[
            'sort'=>$sort
        ]);
    }
}
