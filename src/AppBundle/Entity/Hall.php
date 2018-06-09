<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Hall
 *
 * @ORM\Table(name="hall")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HallRepository")
 */
class Hall
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;


    /**
     * @var integer
     *
     * @ORM\Column(name="numberOfSeats_Normal", type="integer", length=255, unique=false)
     */
    private $numberOfSeats_Normal;


    /**
     * @var integer
     *
     * @ORM\Column(name="numberOfSeats_Handicapped", type="integer", length=255, unique=false)
     */
    private $numberOfSeats_Handicapped;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CinemaShow", mappedBy="hall")
     */
    private $cinemaShows;

    public function __construct()
    {
        $this->cinemaShows = new ArrayCollection();
    }

    /**
     * Get numberOfSeats_Normal
     *
     * @return int
     */
    public function getNumberOfSeatsNormal()
    {
        return $this->numberOfSeats_Normal;
    }

    /**
     * Set numberOfSeats_Normal
     * @param integer $numberOfSeats_Normal
     * @return Hall
     */
    public function setNumberOfSeatsNormal($numberOfSeats_Normal)
    {
        $this->numberOfSeats_Normal = $numberOfSeats_Normal;
        return $this;
    }

    /**
     * Get numberOfSeats_Handicapped
     *
     * @return int
     */
    public function getNumberOfSeatsHandicapped()
    {
        return $this->numberOfSeats_Handicapped;
    }

    /**
     * Set numberOfSeats_Handicapped
     * @param integer $numberOfSeats_Handicapped
     * @return Hall
     */
    public function setNumberOfSeatsHandicapped($numberOfSeats_Handicapped)
    {
        $this->numberOfSeats_Handicapped = $numberOfSeats_Handicapped;
        return $this;
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
     * @return Hall
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
     * @return ArrayCollection
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
        $cinemaShow->getReservation()->add($this);
    }
}
