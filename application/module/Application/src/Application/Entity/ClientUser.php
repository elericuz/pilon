<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientUser
 *
 * @ORM\Table(name="client_user", uniqueConstraints={@ORM\UniqueConstraint(name="cluv_user", columns={"cluv_user"})}, indexes={@ORM\Index(name="IX_has_user", columns={"clii_id"})})
 * @ORM\Entity
 */
class ClientUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="clui_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cluiId;

    /**
     * @var integer
     *
     * @ORM\Column(name="clui_type", type="integer", nullable=true)
     */
    private $cluiType = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="cluv_user", type="string", length=32, nullable=true)
     */
    private $cluvUser;

    /**
     * @var string
     *
     * @ORM\Column(name="cluv_password", type="string", length=32, nullable=true)
     */
    private $cluvPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="cluv_name", type="string", length=150, nullable=true)
     */
    private $cluvName;

    /**
     * @var string
     *
     * @ORM\Column(name="cluv_lastname", type="string", length=150, nullable=true)
     */
    private $cluvLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="cluv_email", type="string", length=150, nullable=true)
     */
    private $cluvEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="clui_status", type="integer", nullable=true)
     */
    private $cluiStatus = '1';

    /**
     * @var \Application\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clii_id", referencedColumnName="clii_id")
     * })
     */
    private $clii;



    /**
     * Get cluiId
     *
     * @return integer
     */
    public function getCluiId()
    {
        return $this->cluiId;
    }

    /**
     * Set cluiType
     *
     * @param integer $cluiType
     * @return ClientUser
     */
    public function setCluiType($cluiType)
    {
        $this->cluiType = $cluiType;

        return $this;
    }

    /**
     * Get cluiType
     *
     * @return integer
     */
    public function getCluiType()
    {
        return $this->cluiType;
    }

    /**
     * Set cluvUser
     *
     * @param string $cluvUser
     * @return ClientUser
     */
    public function setCluvUser($cluvUser)
    {
        $this->cluvUser = $cluvUser;

        return $this;
    }

    /**
     * Get cluvUser
     *
     * @return string
     */
    public function getCluvUser()
    {
        return $this->cluvUser;
    }

    /**
     * Set cluvPassword
     *
     * @param string $cluvPassword
     * @return ClientUser
     */
    public function setCluvPassword($cluvPassword)
    {
        $this->cluvPassword = $cluvPassword;

        return $this;
    }

    /**
     * Get cluvPassword
     *
     * @return string
     */
    public function getCluvPassword()
    {
        return $this->cluvPassword;
    }

    /**
     * Set cluvLastname
     *
     * @param string $cluvLastname
     * @return ClientUser
     */
    public function setCluvLastname($cluvLastname)
    {
        $this->cluvLastname = $cluvLastname;

        return $this;
    }

    /**
     * Set cluvName
     *
     * @param string $cluvName
     * @return ClientUser
     */
    public function setCluvName($cluvName)
    {
        $this->cluvName = $cluvName;

        return $this;
    }

    /**
     * Set cluvEmail
     *
     * @param string $cluvEmail
     * @return ClientUser
     */
    public function setCluvEmail($cluvEmail)
    {
        $this->cluvEmail = $cluvEmail;

        return $this;
    }

    /**
     * Get cluvName
     *
     * @return string
     */
    public function getCluvName()
    {
        return $this->cluvName;
    }

    /**
     * Get cluvLastname
     *
     * @return string
     */
    public function getCluvLastname()
    {
        return $this->cluvLastname;
    }

    /**
     * Get cluvEmail
     *
     * @return string
     */
    public function getCluvEmail()
    {
        return $this->cluvEmail;
    }

    /**
     * Set cluiStatus
     *
     * @param integer $cluiStatus
     * @return ClientUser
     */
    public function setCluiStatus($cluiStatus)
    {
        $this->cluiStatus = $cluiStatus;

        return $this;
    }

    /**
     * Get cluiStatus
     *
     * @return integer
     */
    public function getCluiStatus()
    {
        return $this->cluiStatus;
    }

    /**
     * Set clii
     *
     * @param \Application\Entity\Client $clii
     * @return ClientUser
     */
    public function setClii(\Application\Entity\Client $clii = null)
    {
        $this->clii = $clii;

        return $this;
    }

    /**
     * Get clii
     *
     * @return \Application\Entity\Client
     */
    public function getClii()
    {
        return $this->clii;
    }
}
