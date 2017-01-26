<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 28/11/16
 * Time: 19:50
 */

namespace Romenys\Helpers;

trait CreatedAtTrait
{
    private $createdAt;

    public function setCreatedAt($dateParams = null)
    {
        $dateParams = is_null($dateParams) ? "NOW" : $dateParams;
        $this->createdAt = new \DateTime($dateParams);

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        $this->setCreatedAt();

        return $this->getCreatedAt();
    }
}

