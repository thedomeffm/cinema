<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @var float
     *
     * @ORM\Column(name="endprice", type="float", length=255, unique=false)
     */
    private $endprice;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CinemaShow", inversedBy="reservation")
     */
    private $cinemaShow;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="reservation")
     */
    private $person;

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
     * Get person
     *
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set person
     *
     * @param Person $person
     */
    public function setPerson(Person $person)
    {
        $this->person = $person;
    }

    /**
     * Get cinemaShow
     *
     * @return CinemaShow
     */
    public function getReservation()
    {
        return $this->cinemaShow;
    }

    /**
     * Set cinemaShow
     *
     * @param CinemaShow $cinemaShow
     */
    public function setCinemaShow (CinemaShow $cinemaShow)
    {
        $this->cinemaShow = $cinemaShow;
    }

    /**
     * Set endprice.
     *
     * @param float $endprice
     *
     * @return Reservation
     */
    public function setEndprice($endprice)
    {
        $this->endprice = $endprice;

        return $this;
    }

    /**
     * Get endprice.
     *
     * @return float
     */
    public function getEndprice()
    {
        return $this->endprice;
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
     * @return Reservation
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
     * @return Reservation
     */
    public function setNumberOfSeatsHandicapped($numberOfSeats_Handicapped)
    {
        $this->numberOfSeats_Handicapped = $numberOfSeats_Handicapped;
        return $this;
    }
}
