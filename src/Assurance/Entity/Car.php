<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 05/12/16
 * Time: 20:12
 */

namespace Examples\Entity;

use Romenys\Framework\Components\Model;

class Car extends Model
{
    private $id;

    private $brand = '';

    private $pictures = [];

    private $user;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     *
     * @return Car
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return array
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @param array $pictures
     */
    public function setPictures($pictures)
    {
        $this->pictures = $pictures;
    }

    /**
     * @param $picture
     *
     * @return Car
     */
    public function addPictures($picture)
    {
        $this->pictures[] = $picture;

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
     * @param User $user
     *
     * @return Car
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

}