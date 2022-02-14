<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExemplesModeleController extends AbstractController
{
    #[Route('/exemples/modele/exemple/insert', name: 'exemples_modele')]
    public function exempleInsert(EntityManagerInterface $em): Response
    {
        // $livre = new Livre;
        $livre1 = new Livre(['titre'=>'La vie','isbn'=>'323141324234']);
        $livre2 = new Livre(['titre'=>'Le Hobbit','isbn'=>'128945621437']);

        //$em = $doctrine->getManager(); // pas extra pour obtenir l'entity manager
        
        $em->persist ($livre1);
        $em->persist ($livre2);
        
        $em->flush();
        dump ($livre1);
        dd($livre2);
        
        // hydrate pour éviter les sets
        // $livre1->setTitre;
        // $livre->setIsbn;
        // return $this->render('exemples_modele/exemple_insert.html.twig');
    
        
    }

    #[Route ('/exemple/modele/exemple/insert/manager/registry/client')]
    public function exempleInsertManagerRegistryClient (ManagerRegistry $doctrine) {
        $c1 = new Client(['nom'=>'Tototo','email'=>'tototo@gmail.com']);

        $em = $doctrine->getManager();
        $em->persist($c1);
        dump("avant flush");
        dump($c1);

        $em->flush();
        dump("après flush");
        dump($c1);
        dd("c'est la fin");

        dump ("c'est la fin");
        die();
    }

    #[Route('/exemple/modele/exemple/select/find/one/by')]
    public function exempleSelectFindOneBy (ManagerRegistry $doctrine){
        // on va chercher les livres dont le titre est : "La vie"
        $em = $doctrine->getManager();
        $rep = $em->getRepository(Livre::class); //"App/Entity/.. = moche et lourd
        $objetLivre = $rep->findOneBy(['titre' => 'La vie','isbn' => '323141324234']); // WHERE avec AND
        // dump ($objetLivre->getTitre);
        // dump ($objetLivre->getIsbn);
        // dd($objetLivre);


        $vars = ['livre' => $objetLivre];
        return $this->render('exemples_modele/exemple_select_find_one_by.html.twig', $vars);

    }
}
