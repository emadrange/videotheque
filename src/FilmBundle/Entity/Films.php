<?php

namespace FilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Films
 *
 * @ORM\Table(name="films")
 * @ORM\Entity(repositoryClass="FilmBundle\Repository\FilmsRepository")
 */
class Films
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
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\Length(
     *     min="2",
     *     max="255",
     *     minMessage="Le titre est trop court",
     *     maxMessage="Le titre est trop long"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string",length=100)
     * @Assert\Length(
     *     min="2",
     *     max="100",
     *     minMessage="Le nom de l'auteur est trop court",
     *     maxMessage="Le nom de l'auteur est trop long"
     * )
     */
    private $author;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="FilmBundle\Entity\Genres")
     * @ORM\JoinColumn(name="genre_id",referencedColumnName="id")
     */
    private $genre;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="FilmBundle\Entity\Productions")
     * @ORM\JoinColumn(name="prod_id",referencedColumnName="id")
     */
    private $production;

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=50, nullable=true)
     * @Assert\Length(
     *     min="5",
     *     max="50",
     *     minMessage="Minimum 5 caractères pour la jaquette",
     *     maxMessage="Maximum 50 caractères pour la jaquette"
     * )
     */
    private $cover;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="string", length=500, nullable=true)
     * @Assert\Length(
     *     max="500",
     *     maxMessage="Le résumé doit faire maximum 500 caractères"
     * )
     */
    private $resume;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $datecreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="release_year", type="datetime", nullable=true)
     */
    private $releaseyear;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=50, nullable=true)
     * @Assert\Length(
     *     max="50",
     *     maxMessage="Maximum 50 caractères pour la durée"
     * )
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="actor", type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="255",
     *     maxMessage="Maximum 255 caractères pour les acteurs"
     * )
     */
    private $actor;

    /**
     * Films constructor.
     */
    public function __construct()
    {
        $this->datecreation = new \DateTime();
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Films
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Films
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set genre
     *
     * @param integer $genre
     *
     * @return Films
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return int
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set production
     *
     * @param integer $production
     *
     * @return Films
     */
    public function setProduction($production)
    {
        $this->production = $production;

        return $this;
    }

    /**
     * Get production
     *
     * @return int
     */
    public function getProduction()
    {
        return $this->production;
    }

    /**
     * Set cover
     *
     * @param string $cover
     *
     * @return Films
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set resume
     *
     * @param string $resume
     *
     * @return Films
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Films
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set releaseyear
     *
     * @param \DateTime $releaseyear
     *
     * @return Films
     */
    public function setReleaseyear($releaseyear)
    {
        $this->releaseyear = $releaseyear;

        return $this;
    }

    /**
     * Get releaseyear
     *
     * @return \DateTime
     */
    public function getReleaseyear()
    {
        return $this->releaseyear;
    }

    /**
     * Set duration
     *
     * @param string $duration
     *
     * @return Films
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set actor
     *
     * @param string $actor
     *
     * @return Films
     */
    public function setActor($actor)
    {
        $this->actor = $actor;

        return $this;
    }

    /**
     * Get actor
     *
     * @return string
     */
    public function getActor()
    {
        return $this->actor;
    }
}

