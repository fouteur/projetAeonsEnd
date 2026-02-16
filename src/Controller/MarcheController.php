<?php

namespace App\Controller;

use App\Repository\GemmesRepository;
use App\Repository\ReliqueRepository;
use App\Repository\SortRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



final class MarcheController extends AbstractController  
{

    #[Route("/marche0", name: "marche0")]
    function marche0(Request $request, GemmesRepository $gemmesR ,ReliqueRepository $reliquesR, SortRepository $sortsR):Response{
        $extensions = $this->getExtensions($request);
       
      
        
        $gemmes=$gemmesR->findRandomGemmes(3, $extensions);
        $reliques = $reliquesR->findRandomReliques(2, $extensions);
        $sorts = $sortsR->findRandomSorts(4, $extensions);

      
        $gemmes= $this->order($gemmes);     
        $reliques= $this->order($reliques);
        $sorts= $this->order($sorts);

       
        $reserves =array_merge($gemmes,$reliques,$sorts);
        return $this-> render('marche/index.html.twig',[
    
            'reserves'=>$reserves,
            'marcheType'=>'marché aléatoire'
        ]);

        /* en PHP pure
        return new Response('yo '. $_GET['name']);
        */
    }
    #[Route("/marche1",name: "marche1")]
    function marche1(Request $request, GemmesRepository $gemmesR ,ReliqueRepository $reliquesR, SortRepository $sortsR):Response{
        $extensions = $this->getExtensions($request);
        do {
            $gemme1= $gemmesR->findRandomWithMaxCout(3, $extensions);
            $gemme2= $gemmesR->findRandomWithCout(4, $extensions);
            $gemme3= $gemmesR->findRandomGemmes(1, $extensions)[0];   
        } while($gemme1 ==  $gemme2 || $gemme1 == $gemme3 || $gemme2 == $gemme3);
        
        do {
            $sort1= $sortsR->findRandomWithMaxCout(5, $extensions); 
            $sort2= $sortsR->findRandomWithMaxCout(5, $extensions);
            $sort3= $sortsR->findRandomWithMinCout(5, $extensions);
            $sort4= $sortsR->findRandomWithMinCout(5, $extensions);
        } while($sort1 == $sort2 || $sort1 == $sort3 || $sort1 == $sort4 || 
                $sort2 == $sort3 || $sort2 == $sort4 || $sort3 == $sort4);


        $gemmes=[$gemme1, $gemme2, $gemme3];
        $reliques = $reliquesR->findRandomReliques(2, $extensions);
        $sorts = [$sort1, $sort2, $sort3, $sort4];

        $gemmes= $this->order($gemmes);     
        $reliques= $this->order($reliques);   
        $sorts= $this->order($sorts);
   
        $reserves =array_merge($gemmes,$reliques,$sorts);

        return $this-> render('marche/index.html.twig',[
            'reserves'=>$reserves,
            'marcheType'=>'marché 1'
        ]);
    }
    #[Route("/marche2",name: "marche2")]
    function marche2(Request $request, GemmesRepository $gemmesR ,ReliqueRepository $reliquesR, SortRepository $sortsR):Response{
        $extensions = $this->getExtensions($request);
        
        do{ 
            $gemme1= $gemmesR->findRandomWithMinCout(3, $extensions);
            $gemme2= $gemmesR->findRandomWithMinCout(3, $extensions);
            $gemme3= $gemmesR->findRandomWithMinCout(3, $extensions);   
        }while($gemme1 ==  $gemme2 || $gemme1 == $gemme3 || $gemme2 == $gemme3);

        do {
            $relique1= $reliquesR->findRandomWithMaxCout(4, $extensions);
            $relique2= $reliquesR->findRandomReliques(1, $extensions)[0];
        }  while($relique1 ==  $relique2);

        do {
            $sort1= $sortsR->findRandomWithMaxCout(6, $extensions); 
            $sort2= $sortsR->findRandomWithMaxCout(6, $extensions); 
            $sort3= $sortsR->findRandomWithMinCout(6, $extensions); 
            $sort4= $sortsR->findRandomWithMinCout(6, $extensions);
        } while($sort1 == $sort2 || $sort1 == $sort3 || $sort1 == $sort4 || 
                $sort2 == $sort3 || $sort2 == $sort4 || $sort3 == $sort4);

        $gemmes=[$gemme1, $gemme2, $gemme3];
        $reliques=[$relique1, $relique2];   
        $sorts= [$sort1, $sort2, $sort3, $sort4];

        $gemmes= $this->order($gemmes); 
        $reliques= $this->order($reliques);
        $sorts= $this->order($sorts);
       
        $reserves =array_merge($gemmes,$reliques,$sorts);
      
        return $this-> render('marche/index.html.twig',[
            'reserves'=>$reserves,
            'marcheType'=>'marché 2'
        ]);
    }

    #[Route("/marche3",name: "marche3")]
    function marche3(Request $request, GemmesRepository $gemmesR ,ReliqueRepository $reliquesR, SortRepository $sortsR):Response{
        $extensions = $this->getExtensions($request);
        
        do {
            $gemme1= $gemmesR->findRandomWithMaxCout(4, $extensions);
            $gemme2= $gemmesR->findRandomBetweenCout(4,5, $extensions);
            $gemme3= $gemmesR->findRandomBetweenCout(4,5, $extensions);   
        } while($gemme1 ==  $gemme2 || $gemme1 == $gemme3 || $gemme2 == $gemme3);
        
        do {
            $sort1= $sortsR->findRandomWithCout(3, $extensions); 
            $sort2= $sortsR->findRandomWithCout(4, $extensions);
            $sort3= $sortsR->findRandomWithMinCout(5, $extensions);
            $sort4= $sortsR->findRandomWithMinCout(5, $extensions);
            $sort5= $sortsR->findRandomWithMinCout(5, $extensions);
        } while($sort1 == $sort2 || $sort1 == $sort3 || $sort1 == $sort4 || $sort1 == $sort5 ||
                $sort2 == $sort3 || $sort2 == $sort4 || $sort2 == $sort5 ||
                $sort3 == $sort4 || $sort3 == $sort5 || 
                $sort4 == $sort5);
            

        $gemmes=[$gemme1, $gemme2, $gemme3];
        $reliques = $reliquesR->findRandomReliques(1, $extensions);
        $sorts = [$sort1, $sort2, $sort3, $sort4, $sort5];

        $gemmes= $this->order($gemmes);     
        $reliques= $this->order($reliques);   
        $sorts= $this->order($sorts);

        $reserves =array_merge($gemmes,$reliques,$sorts);

        return $this-> render('marche/index.html.twig',[
            'reserves'=>$reserves,
            'marcheType'=>'marché 3'
        ]);
    }

    #[Route("/marche4",name: "marche4")]
    function marche4(Request $request, GemmesRepository $gemmesR ,ReliqueRepository $reliquesR, SortRepository $sortsR):Response{
        $extensions = $this->getExtensions($request);
        
        do{ 
            $gemme1= $gemmesR->findRandomWithMaxCout(4, $extensions);
            [$gemme2,$gemme3]= $gemmesR->findRandomGemmes(2, $extensions  );
         
        }while($gemme1 ==  $gemme2 || $gemme1 == $gemme3 || $gemme2 == $gemme3);

        do {
            $relique1= $reliquesR->findRandomWithMaxCout(4, $extensions);
            $relique2= $reliquesR->findRandomWithMinCout(4, $extensions);
            $relique3= $reliquesR->findRandomReliques(1, $extensions)[0];
        }  while($relique1 ==  $relique2 || $relique1 == $relique3 || $relique2 == $relique3);

        do {
            $sort1= $sortsR->findRandomWithMaxCout(5, $extensions); 
            $sort2= $sortsR->findRandomWithMinCout(5, $extensions); 
            $sort3= $sortsR->findRandomSorts(1, $extensions)[0]; 

        } while($sort1 == $sort2 || $sort1 == $sort3 || $sort2 == $sort3);

        $gemmes=[$gemme1, $gemme2, $gemme3];
        $reliques=[$relique1, $relique2, $relique3];   
        $sorts= [$sort1, $sort2, $sort3];

        $gemmes= $this->order($gemmes); 
        $reliques= $this->order($reliques);
        $sorts= $this->order($sorts);
       
        $reserves =array_merge($gemmes,$reliques,$sorts);
      
        return $this-> render('marche/index.html.twig',[
            'reserves'=>$reserves,
            'marcheType'=>'marché 4'
        ]);

    }

    #[Route("/marche5",name: "marche5")]
    function marche5(Request $request, GemmesRepository $gemmesR ,ReliqueRepository $reliquesR, SortRepository $sortsR):Response{
        $extensions = $this->getExtensions($request);

        do {
            $gemme1= $gemmesR->findRandomWithCout(2, $extensions);
            $gemme2= $gemmesR->findRandomWithCout(3, $extensions);
            $gemme3= $gemmesR->findRandomWithCout(4, $extensions); 
            $gemme4= $gemmesR->findRandomWithCout(5, $extensions);   
        } while($gemme1 ==  $gemme2 || $gemme1 == $gemme3 || $gemme1 == $gemme4 ||
                 $gemme2 == $gemme3 || $gemme2 == $gemme4 || $gemme3 == $gemme4);

        do {
            $sort1= $sortsR->findRandomWithCout(4, $extensions); 
            $sort2= $sortsR->findRandomWithCout(5, $extensions);
            $sort3= $sortsR->findRandomWithCout(6, $extensions);    
            $sort4= $sortsR->findRandomWithMinCout(6, $extensions);
        } while($sort1 == $sort2 || $sort1 == $sort3 || $sort1 == $sort4 || 
                $sort2 == $sort3 || $sort2 == $sort4 || $sort3 == $sort4);

        $gemmes=[$gemme1, $gemme2, $gemme3, $gemme4];
        $reliques = $reliquesR->findRandomReliques(1, $extensions);
        $sorts = [$sort1, $sort2, $sort3, $sort4];

        $gemmes= $this->order($gemmes);     
        $reliques= $this->order($reliques);
        $sorts= $this->order($sorts);

       
        $reserves =array_merge($gemmes,$reliques,$sorts);
      
        return $this-> render('marche/index.html.twig',[
            'reserves'=>$reserves,
            'marcheType'=>'marché 5'
        ]);
    }

    #[Route("/marche6",name: "marche6")]
    function marche6(Request $request, GemmesRepository $gemmesR ,ReliqueRepository $reliquesR, SortRepository $sortsR):Response{
        $extensions = $this->getExtensions($request);

        do {
            $gemme1= $gemmesR-> findRandomWithCout(3, $extensions);
            $gemme2= $gemmesR-> findRandomWithCout(4, $extensions);
             
        } while($gemme1 ==  $gemme2) ;

        do {
            $relique1= $reliquesR-> findRandomWithMaxCout(4, $extensions);
            $relique2= $reliquesR-> findRandomWithMinCout(4, $extensions);
            $relique3= $reliquesR-> findRandomReliques(1, $extensions)[0];
        }  while($relique1 ==  $relique2 || $relique1 == $relique3 || $relique2 == $relique3);

        do {
            $sort1= $sortsR-> findRandomBetweenCout(3,4, $extensions);  
            $sort2= $sortsR-> findRandomBetweenCout(5,6, $extensions); 
            $sort3= $sortsR-> findRandomBetweenCout(5,6, $extensions);
            $sort4= $sortsR-> findRandomWithMinCout(6, $extensions);
        } while($sort1 == $sort2 || $sort1 == $sort3 || $sort2 == $sort3 || 
                $sort1 == $sort4 || $sort2 == $sort4 || $sort3 == $sort4);

        
        $gemmes=[$gemme1, $gemme2];
        $reliques=[$relique1, $relique2, $relique3];   
        $sorts= [$sort1, $sort2, $sort3, $sort4];

        $gemmes= $this->order($gemmes); 
        $reliques= $this->order($reliques);
        $sorts= $this->order($sorts);
       
        $reserves =array_merge($gemmes,$reliques,$sorts);
      
        return $this-> render('marche/index.html.twig',[
            'reserves'=>$reserves,
            'marcheType'=>'marché 6'
        ]);
    }


    function order(array $items){
        $ordered =  [];
        while(count($items) > 0){
            $max = $items[0]->getCout();
            $maxKey = 0;
            for($j=0; $j < count($items); $j++){
                if($items[$j]->getCout() > $max){
                    $max = $items[$j]->getCout();
                    $maxKey = $j;
                }
            }
            array_unshift($ordered, $items[$maxKey]);
            array_splice($items, $maxKey, 1);
      
        };
        return $ordered;
    }

    private function getExtensions(Request $request): array
    {
        $session = $request->getSession();
        $extensions = $session->get('extensions', []);
        if (empty($extensions)) {
            $extensions = ['rêves brisés (RB)','les paria (LP)','de vieux souvenirs (DVS)','Le Vide (V)','Guerre Eternelle (W)','Base','Les Sans-Nom (N)','Secrets Enfouis (SE)','ere nouvelle (EN)','ere nouvelle (P)',"Ténèbres d'ailleurs"];
            $session->set('extensions', $extensions);
        }
        return $extensions;
    }
}
