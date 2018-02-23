<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Memo;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MemoType;


class MemoController extends Controller
{
    private function _getMemos(){
        $repo = $this->getDoctrine()->getRepository(Memo::class);
        $liste = $repo->findAll();
        return $liste;                     
    }

    private function _getMemo($id){
        $repo = $this->getDoctrine()->getRepository(Memo::class);
        $liste = $repo->find($id);
        return $liste;                     
    }

    private function _getMemoType($type){
        $repo = $this->getDoctrine()->getRepository(Memo::class);
        $liste = $repo->findByType($type);
        return $liste;                     
    }



    /**
    * @Route("/memos", name="TousMemos")
    */
        
    public function displayMemos(){
        $bdd = $this->_getMemos();
        return $this->render(
            "liste.html.twig",
            array( "memo" => $bdd )
        );      
    }

   
     /**
    *@Route("memo/{id}", name="DetailsMemo",requirements={"id"="\d*"})
     */
    public function displayMemo($id){
        $bdd = $this->_getMemo($id);
        return $this->render(
            "details.html.twig",
            array( "memo" => $bdd )
        );      
    }






    /**
    * @Route("memo/ajouter", name="AddMemo")
    */
        
    public function AddMemo(Request $request){        
        $user = $this->getUser();

        $memo = new Memo();                    
        $form= $this->createForm(MemoType::class, $memo);
        $form->handleRequest($request);

       
        $msg="";

        if($form->isSubmitted() ){

        if($form->isValid()){
            
            $manager = $this->getDoctrine()->getManager();
            $memo = $form->getData();
            $memo->setUtilisateur($user);
            $manager->persist($memo);
            $manager->flush();
            
            

            $msg= "Memo ajouté avec succes";           
            }

        else{
            $msg= "Vous avez oublié de remplir un champs";
              }
          }
        
        return $this->render("FormMemo.html.twig", array("form"=>$form->createView(),"msg"=>$msg)); 
        }           
        
   
    
     /**
    *@Route("memo/supprimer/{id}", name="SuppMemo",requirements={"id"="\d*"})
     */
    public function SuppMemo(Memo $memo){
        $repo = $this->getDoctrine()->getManager();
        $repo->remove($memo);
        $repo->flush();

        return $this->render("liste.html.twig", array("memo"=>$memo));    
    } 


    
     /**
    *@Route("memo/modifier/{id}", name="modifMemo",requirements={"id"="\d*"})
     */
    public function modifMemo(Request $request, Memo $memo){
        $form= $this->createForm(MemoType::class, $memo);
        $form->handleRequest($request);
        
        $msg="";

        if($form->isSubmitted() ){

        if($form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($memo);
            $manager->flush();

            $msg= "Produit modifié avec succes";   
            return $this->render("details.html.twig", array( "memo"=>$memo )
            );       

            }

        else{
            $msg= "Vous avez oublié de remplir un champs";
            }
        }

        return $this->render("FormMemo.html.twig", array("form"=>$form->createView(),"msg"=>$msg, "memo"=>$memo));    
    } 


   
     /**
    *@Route("memo/{type}", name="TypeMemo")
     */
    public function displayMemoType($type){
        $bdd = $this->_getMemoType($type);
        return $this->render(
            "ListeType.html.twig",
            array( "memo" => $bdd )
        );      
    }





}