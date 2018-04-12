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
     * @ORM\Column(name="finalprice", type="float")
     */
    private $finalprice;


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
     * Set finalprice.
     *
     * @param float $finalprice
     *
     * @return Reservation
     */
    public function setFinalprice($finalprice)
    {
        $this->finalprice = $finalprice;

        return $this;
    }

    /**
     * Get finalprice.
     *
     * @return float
     */
    public function getFinalprice()
    {
        return $this->finalprice;
    }
}
