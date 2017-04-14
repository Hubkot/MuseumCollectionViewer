<?php

namespace McvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artifact
 *
 * @ORM\Table(name="artifact")
 * @ORM\Entity(repositoryClass="McvBundle\Repository\ArtifactRepository")
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
}

