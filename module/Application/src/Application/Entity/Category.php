<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category", indexes={@ORM\Index(name="radar_id", columns={"radar_id"})})
 * @ORM\Entity
 */
class Category
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
     * @var \Application\Entity\Radar
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Radar", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="radar_id", referencedColumnName="id")
     * })
     */
    private $radar;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;



    /** field constants */
    const FIELD_NAME = 'name';
    const FIELD_RADAR = 'radar';
    const FIELD_LEVEL = 'level';

    /** Categories */
    const CAT_MINDSET = 'mind-set';
    const CAT_PRACTICES = 'practices & roles';
    const CAT_RELATIONSHIP = 'relationship';
    const CAT_ENVIRONMENT = 'environment';
    /* new gtha categories */
    const CAT_EN_TEAM = 'Source Code Management';
    const CAT_AL_TEAM = 'Continuous Integration';
    const CAT_CF_TEAM = 'Test Automation';
    const CAT_SS_TEAM = 'Release Management';
    const CAT_HP_TEAM = 'Fail Safes';
    const CAT_TE_TEAM = 'Team Culture';


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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Category
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set radar
     *
     * @param \Application\Entity\Radar $radar
     *
     * @return Category
     */
    public function setRadar(\Application\Entity\Radar $radar = null)
    {
        $this->radar = $radar;

        return $this;
    }

    /**
     * Get radar
     *
     * @return \Application\Entity\Radar
     */
    public function getRadar()
    {
        return $this->radar;
    }
}
