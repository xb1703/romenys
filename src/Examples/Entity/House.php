<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 05/12/16
 * Time: 20:48
 */

namespace Examples\Entity;

use Romenys\Framework\Components\Model;

class House extends Model
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $color = '';

    /**
     * @var User
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     *
     * @return House
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     *
     * @return House
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return  $this;
    }

}