<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FileSystemDownload
 *
 * @ORM\Table(name="file_system_download", indexes={@ORM\Index(name="IX_has_file", columns={"fsci_id"})})
 * @ORM\Entity
 */
class FileSystemDownload
{
    /**
     * @var integer
     *
     * @ORM\Column(name="fsd_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fsdId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fsdd_download_date", type="datetime", nullable=true)
     */
    private $fsddDownloadDate;

    /**
     * @var string
     *
     * @ORM\Column(name="fsdv_download_ip", type="string", length=17, nullable=true)
     */
    private $fsdvDownloadIp;

    /**
     * @var \Application\Entity\FileSystemClient
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\FileSystemClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fsci_id", referencedColumnName="fsci_id")
     * })
     */
    private $fsci;



    /**
     * Get fsdId
     *
     * @return integer 
     */
    public function getFsdId()
    {
        return $this->fsdId;
    }

    /**
     * Set fsddDownloadDate
     *
     * @param \DateTime $fsddDownloadDate
     * @return FileSystemDownload
     */
    public function setFsddDownloadDate($fsddDownloadDate)
    {
        $this->fsddDownloadDate = $fsddDownloadDate;

        return $this;
    }

    /**
     * Get fsddDownloadDate
     *
     * @return \DateTime 
     */
    public function getFsddDownloadDate()
    {
        return $this->fsddDownloadDate;
    }

    /**
     * Set fsdvDownloadIp
     *
     * @param string $fsdvDownloadIp
     * @return FileSystemDownload
     */
    public function setFsdvDownloadIp($fsdvDownloadIp)
    {
        $this->fsdvDownloadIp = $fsdvDownloadIp;

        return $this;
    }

    /**
     * Get fsdvDownloadIp
     *
     * @return string 
     */
    public function getFsdvDownloadIp()
    {
        return $this->fsdvDownloadIp;
    }

    /**
     * Set fsci
     *
     * @param \Application\Entity\FileSystemClient $fsci
     * @return FileSystemDownload
     */
    public function setFsci(\Application\Entity\FileSystemClient $fsci = null)
    {
        $this->fsci = $fsci;

        return $this;
    }

    /**
     * Get fsci
     *
     * @return \Application\Entity\FileSystemClient 
     */
    public function getFsci()
    {
        return $this->fsci;
    }
}
