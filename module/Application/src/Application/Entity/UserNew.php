<?php

namespace Application\Entity;

use ZfcUser\Entity\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 * /
 */
class UserNew implements UserInterface {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer",name="user_id");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\Column(type="string",name="real_name")
     * @var string
     * @access protected
     */
    protected $real_name;

    /**
     *
     * @ORM\Column(type="string",name="email")
     * @var string
     * @access protected
     */
    protected $email;

    /**
     *
     * @ORM\Column(type="datetime",name="birth")
     * @var string
     * @access protected
     */
    protected $birth;

    /**
     *
     * @ORM\Column(type="string",name="country")
     * @var string
     * @access protected
     */
    protected $country;

    /**
     *
     * @ORM\Column(type="string",name="password")
     * @var string
     * @access protected
     */
    protected $password;



    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     * @return UserInterface
     */
    public function setId($id) {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     * @return UserInterface
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getRealname()
    {
        return $this->real_name;
    }

    /**
     * Set real_name
     *
     * @param string $real_name
     * @return UserInterface
     */
    public function setRealname($real_name)
    {
        $this->real_name = $real_name;
        return $this;
    }

    public function getBirth()
    {
        return $this->birth;
    }

    public function setBirth($date)
    {
        $dateS = new \DateTime($date);
        $this->birth = $dateS;
        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

//----------------------------------------------interface
    public function getState() {
        //return $this->state;
    }

    public function setState($state) {
        //$this->state = $state;
        //return $this;
    }

    public function getUsername() {
        //return $this->username;
    }
    public function setUsername($username) {
        //$this->username = $username;
        //return $this;
    }
    public function getDisplayName() {
        //return $this->displayName;
    }

    public function setDisplayName($displayName) {
        //$this->displayName = $displayName;
        //return $this;
    }

}
