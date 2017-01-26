<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 03/12/16
 * Time: 17:08
 */

namespace Examples\Entity;


use Romenys\Framework\Components\Model;
use Romenys\Helpers\CreatedAtTrait;

class User extends Model
{
    use CreatedAtTrait;

    private $id;

    private $name;

    private $email;

    private $avatar;

    private $profile;

    /**
     * @var \DateTime
     */
    private $createdAt;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
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

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setProfile($profile)
    {
        $this->profile = $profile;

        return $this;
    }

    public function getProfile()
    {
        return $this->profile;
    }
}