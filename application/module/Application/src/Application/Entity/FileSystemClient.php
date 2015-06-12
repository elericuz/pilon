<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FileSystemClient
 *
 * @ORM\Table(name="file_system_client", indexes={@ORM\Index(name="has_client", columns={"clii_id"}), @ORM\Index(name="has_fs", columns={"fisi_id"})})
 * @ORM\Entity
 */
class FileSystemClient
{
    /**
     * @var integer
     *
     * @ORM\Column(name="fsci_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fsciId;

    /**
     * @var integer
     *
     * @ORM\Column(name="fsci_parent_id", type="integer", nullable=true)
     */
    private $fsciParentId;

    /**
     * @var string
     *
     * @ORM\Column(name="fscv_real_name", type="string", length=255, nullable=false)
     */
    private $fscvRealName;

    /**
     * @var string
     *
     * @ORM\Column(name="fscv_friendly_name", type="string", length=255, nullable=false)
     */
    private $fscvFriendlyName;

    /**
     * @var string
     *
     * @ORM\Column(name="fsct_description", type="text", nullable=true)
     */
    private $fsctDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fscd_upload_date", type="datetime", nullable=true)
     */
    private $fscdUploadDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="fsci_total_download", type="integer", nullable=true)
     */
    private $fsciTotalDownload = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fsci_status", type="integer", nullable=true)
     */
    private $fsciStatus = '1';

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
     * @var \Application\Entity\FileSystem
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\FileSystem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fisi_id", referencedColumnName="fisi_id")
     * })
     */
    private $fisi;



    /**
     * Get fsciId
     *
     * @return integer 
     */
    public function getFsciId()
    {
        return $this->fsciId;
    }

    /**
     * Set fsciParentId
     *
     * @param integer $fsciParentId
     * @return FileSystemClient
     */
    public function setFsciParentId($fsciParentId)
    {
        $this->fsciParentId = $fsciParentId;

        return $this;
    }

    /**
     * Get fsciParentId
     *
     * @return integer 
     */
    public function getFsciParentId()
    {
        return $this->fsciParentId;
    }

    /**
     * Set fscvRealName
     *
     * @param string $fscvRealName
     * @return FileSystemClient
     */
    public function setFscvRealName($fscvRealName)
    {
        $this->fscvRealName = $fscvRealName;

        return $this;
    }

    /**
     * Get fscvRealName
     *
     * @return string 
     */
    public function getFscvRealName()
    {
        return $this->fscvRealName;
    }

    /**
     * Set fscvFriendlyName
     *
     * @param string $fscvFriendlyName
     * @return FileSystemClient
     */
    public function setFscvFriendlyName($fscvFriendlyName)
    {
        $this->fscvFriendlyName = $fscvFriendlyName;

        return $this;
    }

    /**
     * Get fscvFriendlyName
     *
     * @return string 
     */
    public function getFscvFriendlyName()
    {
        return $this->fscvFriendlyName;
    }

    /**
     * Set fsctDescription
     *
     * @param string $fsctDescription
     * @return FileSystemClient
     */
    public function setFsctDescription($fsctDescription)
    {
        $this->fsctDescription = $fsctDescription;

        return $this;
    }

    /**
     * Get fsctDescription
     *
     * @return string 
     */
    public function getFsctDescription()
    {
        return $this->fsctDescription;
    }

    /**
     * Set fscdUploadDate
     *
     * @param \DateTime $fscdUploadDate
     * @return FileSystemClient
     */
    public function setFscdUploadDate($fscdUploadDate)
    {
        $this->fscdUploadDate = $fscdUploadDate;

        return $this;
    }

    /**
     * Get fscdUploadDate
     *
     * @return \DateTime 
     */
    public function getFscdUploadDate()
    {
        return $this->fscdUploadDate;
    }

    /**
     * Set fsciTotalDownload
     *
     * @param integer $fsciTotalDownload
     * @return FileSystemClient
     */
    public function setFsciTotalDownload($fsciTotalDownload)
    {
        $this->fsciTotalDownload = $fsciTotalDownload;

        return $this;
    }

    /**
     * Get fsciTotalDownload
     *
     * @return integer 
     */
    public function getFsciTotalDownload()
    {
        return $this->fsciTotalDownload;
    }

    /**
     * Set fsciStatus
     *
     * @param integer $fsciStatus
     * @return FileSystemClient
     */
    public function setFsciStatus($fsciStatus)
    {
        $this->fsciStatus = $fsciStatus;

        return $this;
    }

    /**
     * Get fsciStatus
     *
     * @return integer 
     */
    public function getFsciStatus()
    {
        return $this->fsciStatus;
    }

    /**
     * Set clii
     *
     * @param \Application\Entity\Client $clii
     * @return FileSystemClient
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

    /**
     * Set fisi
     *
     * @param \Application\Entity\FileSystem $fisi
     * @return FileSystemClient
     */
    public function setFisi(\Application\Entity\FileSystem $fisi = null)
    {
        $this->fisi = $fisi;

        return $this;
    }

    /**
     * Get fisi
     *
     * @return \Application\Entity\FileSystem 
     */
    public function getFisi()
    {
        return $this->fisi;
    }
}
