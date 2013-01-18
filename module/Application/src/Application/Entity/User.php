<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="usr")
 * /
 */
class User
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer",name="id");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @ORM\Column(type="string",name="name");
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="GrpNew")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    protected $group;


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setGropu(\Application\Entity\GrpNew $group)
    {
        $this->group = $group;
    }

}
