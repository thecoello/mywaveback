<?php

namespace App\Domains;

class User
{
    public $id;
    public $companyname;
    public $name;
    public $country;
    public $region;
    public $email;
    public $password;
    public $usertype;

    public function __construct(string $companyname, string $name, string $country, string $region, string $email, string $password, string $usertype)
    {
        $this->companyname = $companyname;
        $this->name = $name;
        $this->country = $country;
        $this->region = $region;
        $this->email = $email;
        $this->password = $password;
        $this->usertype = $usertype;
    }
    
    /**
     * Get the value of companyname
     */
    public function getcompanyname()
    {
        return $this->companyname;
    }

    /**
     * Set the value of companyname
     */
    public function setcompanyname($companyname): self
    {
        $this->companyname = $companyname;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     */
    public function setCountry($country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set the value of region
     */
    public function setRegion($region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of usertype
     */
    public function getusertype()
    {
        return $this->usertype;
    }

    /**
     * Set the value of usertype
     */
    public function setusertype($usertype): self
    {
        $this->usertype = $usertype;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
}
