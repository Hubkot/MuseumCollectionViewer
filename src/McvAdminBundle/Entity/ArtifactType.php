<?php

namespace McvAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtifactType
 *
 * @ORM\Table(name="artifact_type")
 * @ORM\Entity(repositoryClass="McvAdminBundle\Repository\ArtifactTypeRepository")
 */
class ArtifactType
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
     * @ORM\Column(name="type_name", type="string", length=50, unique=true)
     */
    private $typeName;


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
     * Set typeName
     *
     * @param string $typeName
     *
     * @return ArtifactType
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;

        return $this;
    }

    /**
     * Get typeName
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }
}

