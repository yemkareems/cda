<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeDetails
 *
 * @ORM\Table(name="employee_details", indexes={@ORM\Index(name="emp_id", columns={"emp_id"}), @ORM\Index(name="role_id", columns={"role_id"}), @ORM\Index(name="company_id", columns={"company_id"})})
 * @ORM\Entity
 */
class EmployeeDetails
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
     * @var \Application\Entity\Company
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Company", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * })
     */
    private $company;

    /**
     * @var \Application\Entity\Employee
     *
     * @ORM\OneToOne(targetEntity="Application\Entity\Employee", inversedBy="employeeDetails", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emp_id", referencedColumnName="id")
     * })
     */
    private $emp;

    /**
     * @var \Application\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Role", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;


    /** field constants */
    const FIELD_COMPANY = 'company';
    const FIELD_EMPLOYEE = 'emp';
    const FIELD_ROLE = 'role';

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
     * Set company
     *
     * @param \Application\Entity\Company $company
     *
     * @return EmployeeDetails
     */
    public function setCompany(\Application\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Application\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set emp
     *
     * @param \Application\Entity\Employee $emp
     *
     * @return EmployeeDetails
     */
    public function setEmp(\Application\Entity\Employee $emp = null)
    {
        $this->emp = $emp;

        return $this;
    }

    /**
     * Get emp
     *
     * @return \Application\Entity\Employee
     */
    public function getEmp()
    {
        return $this->emp;
    }

    /**
     * Set role
     *
     * @param \Application\Entity\Role $role
     *
     * @return EmployeeDetails
     */
    public function setRole(\Application\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Application\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }
}
