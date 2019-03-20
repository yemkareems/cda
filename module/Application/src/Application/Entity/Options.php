<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Options
 *
 * @ORM\Table(name="options", indexes={@ORM\Index(name="qid", columns={"qid"})})
 * @ORM\Entity
 */
class Options
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
     * @var \Application\Entity\Question
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Question", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="qid", referencedColumnName="id")
     * })
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="display", type="string", nullable=false)
     */
    private $display;


    /**
     * @var integer
     *
     * @ORM\Column(name="weightage", type="integer", length=11, nullable=false)
     */
    private $weightage;

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
     * Set question
     *
     * @param \Application\Entity\Question $question
     *
     * @return Options
     */
    public function setQuestion($question)
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


    /**
     * Get display
     *
     * @return string
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Set display
     *
     * @param string $display
     *
     * @return Options
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Set weightage
     *
     * @param integer $weightage
     *
     * @return Options
     */
    public function setWeightage($weightage)
    {
        $this->weightage = $weightage;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getWeightage()
    {
        return $this->weightage;
    }

  }
