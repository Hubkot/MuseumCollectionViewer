<?php

namespace McvAdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use McvAdminBundle\Repository\ArtifactFilesRepository;

/**
 * ArtifactFile
 *
 * @ORM\Table(name="artifact_files")
 * @ORM\Entity(repositoryClass="McvAdminBundle\Repository\ArtifactFilesRepository")
 */
class ArtifactFiles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=200, unique=true)
     */
    private $filename;

 
    /**
     * @var string
     *
     * @ORM\Column(name="filepath", type="string", length=200)
     */
    private $filepath;

    /**
     * @var string
     *
     * @ORM\Column(name="category_symbol", type="string", length=1)
     */
    private $categorySymbol;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_number", type="string", length=100)
     */
    private $photoNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="file_copyrights", type="string", length=255, nullable=true)
     */
    private $fileCopyrights;
    
    /**
     * Many Files have One Inventory Number.
     * @ManyToOne(targetEntity="Artifact", inversedBy="artifactFiles")
     * @JoinColumn(name="indirect_files_artifact")
     */
    private $filesArray;
    
    public function __construct() {
        $this->filesArray = new ArrayCollection();
    }
   
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return ArtifactFile
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filepath
     *
     * @param string $filepath
     *
     * @return ArtifactFile
     */
    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;

        return $this;
    }

    /**
     * Get filepath
     *
     * @return string
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    /**
     * Set categorySymbol
     *
     * @param string $categorySymbol
     *
     * @return ArtifactFile
     */
    public function setCategorySymbol($categorySymbol)
    {
        $this->categorySymbol = $categorySymbol;

        return $this;
    }

    /**
     * Get categorySymbol
     *
     * @return string
     */
    public function getCategorySymbol()
    {
        return $this->categorySymbol;
    }

    /**
     * Set photoNumber
     *
     * @param string $photoNumber
     *
     * @return ArtifactFile
     */
    public function setPhotoNumber($photoNumber)
    {
        $this->photoNumber = $photoNumber;

        return $this;
    }

    /**
     * Get photoNumber
     *
     * @return string
     */
    public function getPhotoNumber()
    {
        return $this->photoNumber;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return ArtifactFile
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set fileCopyrights
     *
     * @param string $fileCopyrights
     *
     * @return ArtifactFile
     */
    public function setFileCopyrights($fileCopyrights)
    {
        $this->fileCopyrights = $fileCopyrights;

        return $this;
    }

    /**
     * Get fileCopyrights
     *
     * @return string
     */
    public function getFileCopyrights()
    {
        return $this->fileCopyrights;
    }
    
    public function getFilesArray() {
        return $this->filesArray;
    }

    public function setFilesArray(Artifact $filesArray) {
       $filesArray->getInventoryNumber($this);
        if (!$this->filesArray->contains($filesArray)) {
            $this->filesArray->add($filesArray);
        }
        $this->filesArray = $filesArray;
        return $this;
    }
    
 
}

