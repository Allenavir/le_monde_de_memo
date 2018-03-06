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

     /**
    *@Route("utilisateur", name="DetailsUtilisateur")
     */
    public function displayMemo(){          
               
        return $this->render(
            "detailsUtilisateur.html.twig")     
        ;      
       }


    /**
    * @Route("utilisateur/inscription", name="AddUtilisateur")
    */
        
    public function AddUser(Request $request){        
        $utilisateur = new Utilisateur();                    
        $form= $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

       
        $msg="";

        if($form->isSubmitted() ){

        if($form->isValid()){
            
            $manager = $this->getDoctrine()->getManager();
            $memo = $form->getData();           
            $manager->persist($utilisateur);
            $manager->flush();
            
            

            $msg= "Memo ajouté avec succes";           
            }

        else{
            $msg= "Vous avez oublié de remplir un champs";
              }
          }
        
        return $this->render("FormUtilisateur.html.twig", array("form"=>$form->createView(),"msg"=>$msg)); 
        }           
        
   
    
     /**
    *@Route("utilisateur/supprimer/{id}", name="SuppUtilisateur",requirements={"id"="\d*"})
     */
    public function SuppMemo(Utilisateur $utilisateur){
        $repo = $this->getDoctrine()->getManager();
        $repo->remove($utilisateur);
        $repo->flush();

        return $this->render("listeUtilisateurs.html.twig", array("utilisateur"=>$utilisateur));    
    } 


    
     /**
    *@Route("utilisateur/modifier/{id}", name="modifUtilisateur",requirements={"id"="\d*"})
     */
    public function modifMemo(Request $request, Utilisateur $Utilisateur){

        $user = $this->getUser();
        $user->getId();
        $user->getUsername();
        $user->getMail(); 

        $form= $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        
        $msg="";

        if($form->isSubmitted() ){

        if($form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($utilisateur);
            $manager->flush();

            $msg= "Produit modifié avec succes";   
            return $this->render("detailsUtilisateur.html.twig", array( "utilisateur"=>$utilisateur )
            );       

            }

        else{
            $msg= "Vous avez oublié de remplir un champs";
            }
        }

        return $this->render("FormUtilisateur.html.twig", array("form"=>$form->createView(),"msg"=>$msg));    
    } 
}
    
