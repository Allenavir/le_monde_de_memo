<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UtilisateurType;


class UtilisateurController extends Controller
{
    private function _getUtilisateurs(){
        $repo = $this->getDoctrine()->getRepository(Utilisateur::class);
        $liste = $repo->findAll();
        return $liste;                     
    }


    /**
    * @Route("/utilisateurs", name="TousUtilisateur")
    */
        
    public function displayUtilisateurs(){
        $bdd = $this->_getUtilisateurs();
        return $this->render(
            "listeUtilisateurs.html.twig",
            array( "utilisateur" => $bdd )
        );      
    }
    
}    