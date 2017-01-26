<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 03/12/16
 * Time: 17:08
 */

namespace Examples\Entity;


use Romenys\Framework\Components\Model;
//use Romenys\Helpers\CreatedAtTrait;

class Client extends Model
{
    //use CreatedAtTrait;

    private $id;

    private $nom;

    private $prenom;

    private $email;


    /**
     * @var \DateTime
     */
    //private $createdAt;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
}