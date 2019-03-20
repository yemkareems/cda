<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity
 */
class Employee
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="emp_code", type="string", length=20, nullable=false)
     */
    private $empCode;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=150, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=150, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=200, unique=TRUE, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=200, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy;

    /**
     * @var \Application\Entity\EmployeeDetails
     *
     * @ORM\OneToOne(targetEntity="Application\Entity\EmployeeDetails", mappedBy="emp")
     * @ORM\JoinTable(name="employee_details", joinColumns={@ORM\JoinColumn(name="id", referencedColumnName="emp_id")},
    )
     */
    private $employeeDetails;

    /**
     * @var \Application\Entity\EmployeeTeam
     *
     * @ORM\OneToOne(targetEntity="Application\Entity\EmployeeTeam", mappedBy="emp")
     * @ORM\JoinTable(name="employee_team", joinColumns={@ORM\JoinColumn(name="id", referencedColumnName="emp_id")},
    )
     */
    private $employeeTeam;




    /** field constants */
    const FIELD_EMP_CODE = 'empCode';
    const FIELD_FIRSTNAME = 'firstname';
    const FIELD_LASTNAME = 'lastname';
    const FIELD_EMAIL = 'email';
    const FIELD_PASSWORD = 'password';
    const FIELD_CREATED_AT = 'createdAt';
    const FIELD_CREATED_BY = 'createdBy';


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set empCode
     *
     * @param string $empCode
     *
     * @return Employee
     */
    public function setEmpCode($empCode)
    {
        $this->empCode = $empCode;

        return $this;
    }

    /**
     * Get empCode
     *
     * @return string
     */
    public function getEmpCode()
    {
        return $this->empCode;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Employee
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Employee
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Get firstname lastname
     *
     * @return string
     */
    public function getFullName()
    {
        return ucfirst($this->firstname) .' '. $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Employee
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Employee
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Employee
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return Employee
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Get employeeDetails
     * @return EmployeeDetails
     */
    public function getEmployeeDetails()
    {
        return $this->employeeDetails;
    }

    /**
     * Get employeeTeam
     * @return EmployeeTeam
     */
    public function getEmployeeTeam()
    {
        if(is_object($this->employeeTeam)) {
            return $this->employeeTeam->getTeam();
        } else {
            return null;
        }
    }
}
