<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RatingQuarter
 *
 * @ORM\Table(name="rating_quarter", uniqueConstraints={@ORM\UniqueConstraint(name="question_id", columns={"question_id"})}, indexes={@ORM\Index(name="emp_id", columns={"emp_id"})})
 * @ORM\Entity(repositoryClass="Application\Repository\RatingQuarter")
 */
class RatingQuarter
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
     * @var year
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private $year;

    /**
     * @var integer
     *
     * @ORM\Column(name="quarter", type="integer", nullable=false)
     */
    private $quarter;

    /**
     * @var integer
     *
     * @ORM\Column(name="answer", type="integer", nullable=false)
     */
    private $answer;

    /**
     * @var integer
     *
     * @ORM\Column(name="weightage", type="integer", nullable=false)
     */
    private $weightage;


    /**
     * @var text
     *
     * @ORM\Column(name="comment", type="text", nullable=false)
     */
    private $comment;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    private $datetime;

    /**
     * @var \Application\Entity\Employee
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Employee", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emp_id", referencedColumnName="id")
     * })
     */
    private $emp;

    /**
     * @var \Application\Entity\Question
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Question", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     * })
     */
    private $question;


    /** field constants */
    const FIELD_YEAR = 'year';
    const FIELD_QUARTER = 'quarter';
    const FIELD_ANSWER = 'answer';
    const FIELD_WEIGHTAGE = 'weightage';
    const FIELD_COMMENT = 'comment';
    const FIELD_DATETIME = 'datetime';
    const FIELD_EMPLOYEE = 'emp';
    const FIELD_QUESTION = 'question';


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
     * Set year
     *
     * @param integer $year
     *
     * @return RatingQuarter
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set quarter
     *
     * @param integer $quarter
     *
     * @return RatingQuarter
     */
    public function setQuarter($quarter)
    {
        $this->quarter = $quarter;

        return $this;
    }

    /**
     * Get quarter
     *
     * @return integer
     */
    public function getQuarter()
    {
        return $this->quarter;
    }

    /**
     * Set answer
     *
     * @param integer $answer
     *
     * @return RatingQuarter
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return integer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set weightage
     *
     * @param integer $weightage
     *
     * @return RatingQuarter
     */
    public function setWeightage($weightage)
    {
        $this->weightage = $weightage;

        return $this;
    }

    /**
     * Get weightage
     *
     * @return integer
     */
    public function getWeightage()
    {
        return $this->weightage;
    }


    /**
     * Set comment
     *
     * @param text $comment
     *
     * @return RatingQuarter
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return text
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return RatingQuarter
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set emp
     *
     * @param \Application\Entity\Employee $emp
     *
     * @return RatingQuarter
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
     * Set question
     *
     * @param \Application\Entity\Question $question
     *
     * @return RatingQuarter
     */
    public function setQuestion(\Application\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Application\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
