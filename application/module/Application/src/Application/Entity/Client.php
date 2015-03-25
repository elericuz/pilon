<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
 */
class Client
{
    /**
     * @var integer
     *
     * @ORM\Column(name="clii_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cliiId;

    /**
     * @var string
     *
     * @ORM\Column(name="cliv_name", type="string", length=255, nullable=true)
     */
    private $clivName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="clid_creation_date", type="datetime", nullable=true)
     */
    private $clidCreationDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="clii_status", type="integer", nullable=true)
     */
    private $cliiStatus = '1';



    /**
     * Get cliiId
     *
     * @return integer 
     */
    public function getCliiId()
    {
        return $this->cliiId;
    }

    /**
     * Set clivName
     *
     * @param string $clivName
     * @return Client
     */
    public function setClivName($clivName)
    {
        $this->clivName = $clivName;

        return $this;
    }

    /**
     * Get clivName
     *
     * @return string 
     */
    public function getClivName()
    {
        return $this->clivName;
    }

    /**
     * Set clidCreationDate
     *
     * @param \DateTime $clidCreationDate
     * @return Client
     */
    public function setClidCreationDate($clidCreationDate)
    {
        $this->clidCreationDate = $clidCreationDate;

        return $this;
    }

    /**
     * Get clidCreationDate
     *
     * @return \DateTime 
     */
    public function getClidCreationDate()
    {
        return $this->clidCreationDate;
    }

    /**
     * Set cliiStatus
     *
     * @param integer $cliiStatus
     * @return Client
     */
    public function setCliiStatus($cliiStatus)
    {
        $this->cliiStatus = $cliiStatus;

        return $this;
    }

    /**
     * Get cliiStatus
     *
     * @return integer 
     */
    public function getCliiStatus()
    {
        return $this->cliiStatus;
    }
}
