<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FileSystem
 *
 * @ORM\Table(name="file_system")
 * @ORM\Entity
 */
class FileSystem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="fisi_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fisiId;

    /**
     * @var integer
     *
     * @ORM\Column(name="fisi_type", type="integer", nullable=true)
     */
    private $fisiType = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="fisv_name", type="string", length=32, nullable=true)
     */
    private $fisvName;

    /**
     * @var string
     *
     * @ORM\Column(name="fisv_real_name", type="string", length=255, nullable=true)
     */
    private $fisvRealName;

    /**
     * @var string
     *
     * @ORM\Column(name="fisv_mimetype", type="string", length=30, nullable=true)
     */
    private $fisvMimetype;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fisd_upload_date", type="datetime", nullable=true)
     */
    private $fisdUploadDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="fisv_status", type="integer", nullable=true)
     */
    private $fisvStatus = '1';



    /**
     * Get fisiId
     *
     * @return integer
     */
    public function getFisiId()
    {
        return $this->fisiId;
    }

    /**
     * Set fisiType
     *
     * @param integer $fisiType
     * @return FileSystem
     */
    public function setFisiType($fisiType)
    {
        $this->fisiType = $fisiType;

        return $this;
    }

    /**
     * Get fisiType
     *
     * @return integer
     */
    public function getFisiType()
    {
        return $this->fisiType;
    }

    /**
     * Set fisvName
     *
     * @param string $fisvName
     * @return FileSystem
     */
    public function setFisvName($fisvName)
    {
        $this->fisvName = $fisvName;

        return $this;
    }

    /**
     * Get fisvName
     *
     * @return string
     */
    public function getFisvName()
    {
        return $this->fisvName;
    }

    /**
     * Set fisvRealName
     *
     * @param string $fisvRealName
     * @return FileSystem
     */
    public function setFisvRealName($fisvRealName)
    {
        $this->fisvRealName = $fisvRealName;

        return $this;
    }

    /**
     * Get fisvRealName
     *
     * @return string
     */
    public function getFisvRealName()
    {
        return $this->fisvRealName;
    }

    /**
     * Set fisvMimetype
     *
     * @param string $fisvMimetype
     * @return FileSystem
     */
    public function setFisvMimetype($fisvMimetype)
    {
        $this->fisvMimetype = $fisvMimetype;

        return $this;
    }

    /**
     * Get fisvMimetype
     *
     * @return string
     */
    public function getFisvMimetype()
    {
        return $this->fisvMimetype;
    }

    /**
     * Set fisdUploadDate
     *
     * @param \DateTime $fisdUploadDate
     * @return FileSystem
     */
    public function setFisdUploadDate($fisdUploadDate)
    {
        $this->fisdUploadDate = $fisdUploadDate;

        return $this;
    }

    /**
     * Get fisdUploadDate
     *
     * @return \DateTime
     */
    public function getFisdUploadDate()
    {
        return $this->fisdUploadDate;
    }

    /**
     * Set fisvStatus
     *
     * @param integer $fisvStatus
     * @return FileSystem
     */
    public function setFisvStatus($fisvStatus)
    {
        $this->fisvStatus = $fisvStatus;

        return $this;
    }

    /**
     * Get fisvStatus
     *
     * @return integer
     */
    public function getFisvStatus()
    {
        return $this->fisvStatus;
    }
}
