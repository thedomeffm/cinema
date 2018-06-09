<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CinemaShow
 *
 * @ORM\Table(name="cinema_show")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CinemaShowRepository")
 */
class CinemaShow
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Movie", inversedBy="cinemaShows")
     */
    private $movie;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Hall", inversedBy="cinemaShows")
     */
    private $hall;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Reservation", mappedBy="cinemaShow")
     */
    private $reservation;

    public function __construct()
    {
        $this->reservation = new ArrayCollection();
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
     * Get reservation
     *
     * @return ArrayCollection
     */
    public function getReservation(){
        return $this->reservation;
    }

    /**
     * Set reservation
     * @param Reservation reservation
     */
    public function setReservation(Reservation $reservation)
    {
        $this->reservation->add($reservation);
        $reservation->add($this);
    }



    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return CinemaShow
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return Movie
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @param Movie $movie
     */
    public function setMovie(Movie$movie)
    {
        $this->movie = $movie;
    }

    /**
     * @return Hall
     */
    public function getHall()
    {
        return $this->hall;
    }

    /**
     * @param mixed $hall
     */
    public function setHall($hall)
    {
        $this->hall = $hall;
    }
}
