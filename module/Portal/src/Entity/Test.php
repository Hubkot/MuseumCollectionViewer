<?php
/*  Museum Collection Viewer - Mit License */
namespace Portal\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @ORM\Table(name="test")
 */


class Test {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="name")
     */
    protected $name;
    
    /**
     * @ORM\Column(name="age")
     */
    protected $age;
    
    /**
     * @ORM\Column(name="status")
     */
    protected $status;
       
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setStatus($status) {
        $this->status = $status;
    }


}
