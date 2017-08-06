<?php

namespace McvAdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Artifact
 *
 * @ORM\Table(name="artifact")
 * @ORM\Entity(repositoryClass="McvAdminBundle\Repository\ArtifactRepository")
 */
class Artifact
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
     * @ORM\Column(name="inventory_number", type="string", length=100, unique=true)
     */
    private $inventoryNumber;

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
     * Set inventoryNumber
     *
     * @param string $inventoryNumber
     *
     * @return Artifact
     */
    public function setInventoryNumber($inventoryNumber)
    {
        $this->inventoryNumber = $inventoryNumber;

        return $this;
    }

    /**
     * Get inventoryNumber
     *
     * @return string
     */
    public function getInventoryNumber()
    {
        return $this->inventoryNumber;
    }
  // ...
    /**
     * Many Artifacts belongs to Many Collections.
     * @ManyToMany(targetEntity="Collection", mappedBy="artifactArray")
     */
    private $collectionArray;
    
     /**
     * Many Artifacts belongs to Many Collections.
     * @ManyToMany(targetEntity="Collection", mappedBy="filesArray")
     */
    private $artifactArray;
    
    public function __toString()
    {
        return $this->inventoryNumber;
    }
    
    public function __construct(){
        
        $this->files = new ArrayCollection();
        $this->collectionArray = new ArrayCollection();
    }
    
    
   
}
