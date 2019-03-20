<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question", indexes={@ORM\Index(name="subcategory_id", columns={"subcategory_id"})})
 * @ORM\Entity
 */
class Question
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
     * @ORM\Column(name="question", type="text", length=65535, nullable=false)
     */
    private $question;

    /**
     * @var \Application\Entity\Subcategory
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Subcategory", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subcategory_id", referencedColumnName="id")
     * })
     */
    private $subcategory;

    /**
     * @var \Application\Entity\Options
     *
     * @ORM\OneToMany(targetEntity="Application\Entity\Options", mappedBy="question", cascade={"persist"})
     *
     */
    private $options;


    /** field constants */
    const FIELD_QUESTION = 'question';
    const FIELD_SUB_CATEGORY = 'subcategory';

    /** Answer options */
    const OPTION_STRONGLY_DISAGREE = 'Strongly disagree';
    const OPTION_DISAGREE = 'Disagree';
    const OPTION_NEUTRAL = 'Neutral';
    const OPTION_AGREE = 'Agree';
    const OPTION_STRONGLY_AGREE = 'Strongly agree';

    /** Answer option values */
    const OPTION_VALUE_STRONGLY_DISAGREE = 1;
    const OPTION_VALUE_DISAGREE = 2;
    const OPTION_VALUE_NEUTRAL = 3;
    const OPTION_VALUE_AGREE = 4;
    const OPTION_VALUE_STRONGLY_AGREE = 5;


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
     * @param string $question
     *
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return ucfirst($this->question);
    }

    /**
     * Set subcategory
     *
     * @param \Application\Entity\Subcategory $subcategory
     *
     * @return Question
     */
    public function setSubcategory(\Application\Entity\Subcategory $subcategory = null)
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
     * Get subcategory
     *
     * @return \Application\Entity\Subcategory
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    /**
     * Set options
     *
     * @param \Application\Entity\Options $options
     *
     * @return Question
     */
    public function setOptions(\Application\Entity\Options $options = null)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get Options
     *
     * @return \Application\Entity\Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    public static function getAnswerOptions()
    {
        return array(
            1 => "Yes",
            0 => "No"
        );
        return array(
            self::OPTION_VALUE_STRONGLY_DISAGREE => self::OPTION_STRONGLY_DISAGREE,
            self::OPTION_VALUE_DISAGREE => self::OPTION_DISAGREE,
            self::OPTION_VALUE_NEUTRAL => self::OPTION_NEUTRAL,
            self::OPTION_VALUE_AGREE => self::OPTION_AGREE,
            self::OPTION_VALUE_STRONGLY_AGREE => self::OPTION_STRONGLY_AGREE,
        );
    }
}
