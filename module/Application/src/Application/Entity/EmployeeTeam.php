<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeTeam
 *
 * @ORM\Table(name="employee_team", indexes={@ORM\Index(name="emp_id", columns={"emp_id"}), @ORM\Index(name="team_id", columns={"team_id"})})
 * @ORM\Entity
 */
class EmployeeTeam
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
     * @var \Application\Entity\Employee
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Employee", cascade={"persist"}, inversedBy="employeeDetails")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emp_id", referencedColumnName="id")
     * })
     */
    private $emp;

    /**
     * @var \Application\Entity\Team
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Team", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     * })
     */
    private $team;


    /** field constants */
    const FIELD_EMPLOYEE = 'emp';
    const FIELD_TEAM = 'team';


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
     * Set emp
     *
     * @param \Application\Entity\Employee $emp
     *
     * @return EmployeeTeam
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
     * Set team
     *
     * @param \Application\Entity\Team $team
     *
     * @return EmployeeTeam
     */
    public function setTeam(\Application\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \Application\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}
