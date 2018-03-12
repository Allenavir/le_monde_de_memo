<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;



class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add("username",TextType::class, array("attr"=>array("placeholder"=>"Pseudo"),"required"=>true, "label" => false));
        $builder->add("password",PasswordType::class, array("attr"=>array("placeholder"=>"Mot de Passe"),"required"=>true, "label" => false));
        $builder->add("mail",TextType::class, array("attr"=>array("placeholder"=>"Adresse mail"),"required"=>true, "label" => false));
       
        $builder->add("Save",SubmitType::class,  array("label"=>"Valider"));       
    }
}