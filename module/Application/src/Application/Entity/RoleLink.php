<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_role_linker")
 */
class RoleLink
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer",name="id");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\Column(type="integer",name="user_id")
     * @var string
     */
    protected $user_id;

    /**
     *
     * @ORM\Column(type="string",name="user_email")
     * @var string
     */
    protected $user_email;

    /**
     *
     * @ORM\Column(type="string",name="role_id")
     * @var string
     */
    protected $role_id='user';



    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($id)
    {
        $this->user_id = $id;
    }

    public function getRoleId()
    {
        return $this->role_id;
    }

     public function setRoleId($role)
    {
        return $this->role_id = $role;
    }

    public function getUserEmail()
    {
        return $this->user_email;
    }

     public function setUserEmail($email)
    {
        return $this->user_email = $email;
    }
}
