<?php

namespace FilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Productions
 *
 * @ORM\Table(name="productions")
 * @ORM\Entity(repositoryClass="FilmBundle\Repository\ProductionsRepository")
 */
class Productions
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200)
     * @Assert\Length(
     *     min="2",
     *     max="200",
     *     minMessage="validator.production.name.min",
     *     maxMessage="validator.production.name.max"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=50, nullable=true)
     * @Assert\Length(
     *     min="5",
     *     max="50",
     *     minMessage="validator.production.logo.min",
     *     maxMessage="validator.production.logo.min"
     * )
     */
    private $logo;


    /**
     * Get id
     *
     * @return int
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
     * @return Productions
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
     * Set logo
     *
     * @param string $logo
     *
     * @return Productions
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
}

