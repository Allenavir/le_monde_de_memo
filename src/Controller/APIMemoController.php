<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Memo;
use App\Entity\Utilisateur;
use App\Form\MemoType;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class APIMemoController extends Controller
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

    private function _getMemosTypeUser($type, $id_user){
        $repo = $this->getDoctrine()->getRepository(Memo::class);
        $liste = $repo->findByTypeUser($type, $id_user);
        return $liste;                     
    }

    private function _getMemosByUser($id_user){
        $repo = $this->getDoctrine()->getRepository(Memo::class);
        $liste = $repo->findByUser($id_user);
        return $liste;                     
    }

   
    /**
    * @Route("memos/api/utilisateur", name="MemosByUserAPI")
    * @Method("GET")
    */        
    public function displayMemosByUserAPI(){
        $user = $this->getUser();
        $memos = $this->_getMemosByUser($user->getId());



        $normalizer = new ObjectNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );

        // Choisir la liste des champs à afficher dans la serialisation
        // $options = array("attributes"=>array('id','title','img','additionnal'));
        $rep = new Response($serializer->serialize($memos, 'json'));
        $rep->headers->set('Access-Control-Allow-Origin','http://localhost:4200');
        return $rep;         
    }

   
     /**
    *@Route("api/memo/{id}", name="DetailsMemoAPI",requirements={"id"="\d*"})
     */
    public function displayMemo($id){
        $memo = $this->_getMemo($id);
        //$memo->setImage($request->getUriForPath('/'.$memo->getImage()));

        $normalizer = new ObjectNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );

        $rep = new Response($serializer->serialize($memo, 'json'));
        $rep->headers->set('Access-Control-Allow-Origin','http://localhost:4200');
        return $rep;  
             
    }
    
    /**
    * @Route("api/memo/ajouter", name="AddMemoAPI")
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
    *@Route("api/memo/supprimer/{id}", name="SuppMemoAPI",requirements={"id"="\d*"})
     */
    public function SuppMemo(Memo $memo){
        $repo = $this->getDoctrine()->getManager();
        $repo->remove($memo);
        $repo->flush();

        return $this->render("liste.html.twig", array("memo"=>$memo));    
    } 


    
     /**
    *@Route("api/memo/modifier/{id}", name="modifMemoAPI",requirements={"id"="\d*"})
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
    *@Route("api/memo/{type}", name="TypeMemoAPI")
     */
    public function displayMemoType($type){
        $user = $this->getUser();
        $bdd = $this->_getMemosTypeUser($type , $user);
        return $this->render(
            "ListeType.html.twig",
            array( "memo" => $bdd )
        );      
    }





}