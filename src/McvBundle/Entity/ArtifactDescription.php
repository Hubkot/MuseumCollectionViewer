<?php

namespace McvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * ArtifactDescription
 *
 * @ORM\Table(name="artifact_description")
 * @ORM\Entity(repositoryClass="McvBundle\Repository\ArtifactDescriptionRepository")
 */
class ArtifactDescription
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
     * One description for one artifact
     * @ORM\Column(name="artifact_id", type="integer")
     * @OneToOne(targetEntity="Artifact")
     * @JoinColumn(name="id", referencedColumnName="id")
     */
    private $artifact_id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="story", type="text", nullable=true)
     */
    private $story;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;

    /**
     * @var int
     *
     * @ORM\Column(name="technique", type="integer", nullable=true)
     */
    private $technique;

    /**
     * @var int
     *
     * @ORM\Column(name="material", type="integer", nullable=true)
     */
    private $material;

    /**
     * @var int
     *
     * @ORM\Column(name="author", type="integer", nullable=true)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="copyrights", type="string", length=255, nullable=true)
     */
    private $copyrights;

    /**
     * @var string
     *
     * @ORM\Column(name="financed", type="string", length=255, nullable=true)
     */
    private $financed;

    /**
     * @var array
     *
     * @ORM\Column(name="created_at", type="simple_array", nullable=true)
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer", nullable=true)
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer", nullable=true)
     */
    private $width;

    /**
     * @var int
     *
     * @ORM\Column(name="depth", type="integer", nullable=true)
     */
    private $depth;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer", nullable=true)
     */
    private $weight;


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
     * Get artifact_id
     *
     * @return int
     */
    public function getArtifactId()
    {
        return $this->artifact_id;
    }
    public function setArtifactId($artifact_id)
    {
     $this->artifact_id = $artifact_id;
    }
    /**
     * Set title
     *
     * @param string $title
     *
     * @return ArtifactDescription
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set story
     *
     * @param string $story
     *
     * @return ArtifactDescription
     */
    public function setStory($story)
    {
        $this->story = $story;

        return $this;
    }

    /**
     * Get story
     *
     * @return string
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * Set detail
     *
     * @param string $detail
     *
     * @return ArtifactDescription
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set technique
     *
     * @param integer $technique
     *
     * @return ArtifactDescription
     */
    public function setTechnique($technique)
    {
        $this->technique = $technique;

        return $this;
    }

    /**
     * Get technique
     *
     * @return int
     */
    public function getTechnique()
    {
        return $this->technique;
    }

    /**
     * Set material
     *
     * @param integer $material
     *
     * @return ArtifactDescription
     */
    public function setMaterial($material)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return int
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set author
     *
     * @param integer $author
     *
     * @return ArtifactDescription
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return int
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set copyrights
     *
     * @param string $copyrights
     *
     * @return ArtifactDescription
     */
    public function setCopyrights($copyrights)
    {
        $this->copyrights = $copyrights;

        return $this;
    }

    /**
     * Get copyrights
     *
     * @return string
     */
    public function getCopyrights()
    {
        return $this->copyrights;
    }

    /**
     * Set financed
     *
     * @param string $financed
     *
     * @return ArtifactDescription
     */
    public function setFinanced($financed)
    {
        $this->financed = $financed;

        return $this;
    }

    /**
     * Get financed
     *
     * @return string
     */
    public function getFinanced()
    {
        return $this->financed;
    }

    /**
     * Set createdAt
     *
     * @param array $createdAt
     *
     * @return ArtifactDescription
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return array
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return ArtifactDescription
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return ArtifactDescription
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set depth
     *
     * @param integer $depth
     *
     * @return ArtifactDescription
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * Get depth
     *
     * @return int
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return ArtifactDescription
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }
}

