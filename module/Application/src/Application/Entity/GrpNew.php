<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="grp")
 */
class GrpNew
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer",name="id");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\Column(type="string",name="group_name")
     * @var string
     */
    protected $group_name;


    public function getId()
    {
        return $this->id;
    }

    public function getGroupName()
    {
        return $this->group_name;
    }

    public function setGroupName($name)
    {
        $this->group_name = $name;
    }
}
