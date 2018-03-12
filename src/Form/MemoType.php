<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class MemoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add("titre",TextType::class, array("attr"=>array("placeholder"=>"Titre"),"required"=>true, "label" => false));
        $builder->add("description",TextareaType::class, array("attr"=>array("placeholder"=>"Description"),"required"=>true, "label" => false));
        $builder->add('type', ChoiceType::class, array(
            'choices'  => array(
                'film' => "film",
                'serie' => "serie",
                'anime' => "anime",
                'manga' => "manga",
                'roman' => "roman",
                'comics' => "comics",
                'jeux vidéo' => "jeux video",
                'autres' => "autres"
            ),
            "required"=>true, "label" => false  )); 
        $builder->add("Date",DateType::class, array("required"=>false, "label" => "Date d'ajout", 'format' => 'dd-MM-yyyy')); 
      
       
        $builder->add("Image",TextType::class, array("attr"=>array("placeholder"=>"URL d'une image"),"required"=>false, "label" => false));
        $builder->add("Auteur",TextType::class, array("attr"=>array("placeholder"=>"Nom de l'auteur"),"required"=>false, "label" => false));
        $builder->add("Genre",TextType::class, array("attr"=>array("placeholder"=>"Genre (Sci-fi, romance ...)"),"required"=>false, "label" => false));
        $builder->add("acteurs",TextType::class, array("attr"=>array("placeholder"=>"Acteurs principaux"),"required"=>false, "label" => false));
      
        $builder->add("LienInfo",TextType::class, array("attr"=>array("placeholder"=>"Lien vers un site d'informations sur ce media"),"required"=>false, "label" => false));
        $builder->add("LienStream",TextType::class, array("attr"=>array("placeholder"=>"Lien vers un site de streaming/scans sur ce media"),"required"=>false, "label" => false));
        $builder->add("LienChoix",TextType::class, array("attr"=>array("placeholder"=>"Lien vers un site de votre choix sur ce media"),"required"=>false, "label" => false));
        $builder->add("Supplement",TextareaType::class, array("attr"=>array("placeholder"=>"Informations complémentaires"),"required"=>false, "label" => false));




        $builder->add("Save",SubmitType::class,  array("label"=>"Valider"));       
    }
}