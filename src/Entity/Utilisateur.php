<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur  implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
      /**     
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100,unique=true)
     */
    private $username;
     /**     
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100)
     */
    private $password;
     /**     
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $mail; 

    /**     
     * @ORM\Column(type="string", length=25)
     */
    private $role; 

     /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

   
    /**
     * @ORM\Column(type="integer", nullable=true) 
     * @ORM\OneToMany(targetEntity="App\Entity\Memo", mappedBy="Utilisateur")
    */
    private $memo;
    




    //Setter and getter
    //id
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    //pseudo
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    //password
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    //mail
    public function getMail()
    {
        return $this->mail;
    }
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
    

     //memo
     public function getMemo()
     {
         return $this->memo;
     }
     public function setMemo($memo)
     {
         $this->memo = $memo;
     }

   
    /////////////////////////////////////////////   
    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }
    

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;  
    }
    
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRoles()
    {
        return array($this->role);
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {   
        return json_encode(
        array(
               $this->id,
               $this->username,
               $this->password,
               $this->mail,
               $this->role,
               $this->isActive,
               $this->memo
            )
        );
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->mail,
            $this->role,
            $this->isActive,
            $this->memo
            
        ) = json_decode($serialized);
    }

    
}
