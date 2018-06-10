<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MovieRepository")
 */
class Movie
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="age_rating", type="string", length=255, nullable=true)
     */
    private $ageRating;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="overtime", type="boolean")
     */
    private $overtime;

    /**
     * @var bool
     *
     * @ORM\Column(name="is3d", type="boolean")
     */
    private $is3d;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @Assert\NotBlank(message="Bitte geben Sie eine Bildatei an.")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    private $image;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=false)
     */
    private $normalPrice;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CinemaShow", mappedBy="movie")
     */
    private $cinemaShows;

    public function __construct()
    {
        $this->cinemaShows = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Movie
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set ageRating.
     *
     * @param string|null $ageRating
     *
     * @return Movie
     */
    public function setAgeRating($ageRating = null)
    {
        $this->ageRating = $ageRating;

        return $this;
    }

    /**
     * Get ageRating.
     *
     * @return string|null
     */
    public function getAgeRating()
    {
        return $this->ageRating;
    }

    /**
     * Set duration.
     *
     * @param int $duration
     *
     * @return Movie
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration.
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Movie
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set overtime.
     *
     * @param bool $overtime
     *
     * @return Movie
     */
    public function setOvertime($overtime)
    {
        $this->overtime = $overtime;

        return $this;
    }

    /**
     * Get overtime.
     *
     * @return bool
     */
    public function getOvertime()
    {
        return $this->overtime;
    }

    /**
     * Set is3d.
     *
     * @param bool $is3d
     *
     * @return Movie
     */
    public function setIs3d($is3d)
    {
        $this->is3d = $is3d;

        return $this;
    }

    /**
     * Get is3d.
     *
     * @return bool
     */
    public function getIs3d()
    {
        return $this->is3d;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed image
     *
     * return mixed
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getCinemaShows()
    {
        return $this->cinemaShows;
    }

    /**
     * @param CinemaShow $cinemaShow
     */
    public function setCinemaShows(CinemaShow $cinemaShow)
    {
        $this->cinemaShows->add($cinemaShow);
        $cinemaShow->setMovie($this);
    }

    /**
     * Get normalPrice
     *
     * @return float
     */
    public function getNormalPrice()
    {
        return $this->normalPrice;
    }

    /**
     * Set normalPrice
     *
     * @param float $normalPrice
     */
    public function setNormalPrice($normalPrice)
    {
        $this->normalPrice = $normalPrice;
    }
}
