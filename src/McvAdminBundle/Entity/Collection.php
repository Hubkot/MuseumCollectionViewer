<?php

namespace McvAdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use McvAdminBundle\Repository\CollectionRepository;

/**
 * Collection
 *
 * @ORM\Table(name="collection")
 * @ORM\Entity(repositoryClass="McvAdminBundle\Repository\CollectionRepository")
 */
class Collection
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
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", nullable=true)
     */
    private $description;

    /**
     * Many Collections have Many Artifacts.
     * @ManyToMany(targetEntity="Artifact", inversedBy="collectionArray")
     * @JoinTable(name="indirect_collection_artifact")
     */

    private $artifactArray;

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
     * Set name
     *
     * @param string $name
     *
     * @return Collection
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Collection
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    public function addArtifactArray(Artifact $artifact){
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
    }
    
    public function getArtifactArray(){
        return $this->artifactArray;
    }

    public function removeArtifactArray(Artifact $artifact)
    {
        $this->artifactArray->removeElement($artifact);
    }
    
    public function __construct() {
        $this->artifactArray = new ArrayCollection();
    }
    
}

