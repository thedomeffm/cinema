<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cinema
 *
 * @ORM\Table(name="cinema")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CinemaRepository")
 */
class Cinema
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
     * @ORM\Column(name="base_price", type="float")
     */
    private $basePrice;

    /**
     * @var float
     *
     * @ORM\Column(name="overtime_price", type="float")
     */
    private $overtimePrice;

    /**
     * @var float
     *
     * @ORM\Column(name="is3d_price", type="float")
     */
    private $is3dPrice;


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
     * Set basePrice.
     *
     * @param float $basePrice
     *
     * @return Cinema
     */
    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    /**
     * Get basePrice.
     *
     * @return float
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    /**
     * Set overtimePrice.
     *
     * @param float $overtimePrice
     *
     * @return Cinema
     */
    public function setOvertimePrice($overtimePrice)
    {
        $this->overtimePrice = $overtimePrice;

        return $this;
    }

    /**
     * Get overtimePrice.
     *
     * @return float
     */
    public function getOvertimePrice()
    {
        return $this->overtimePrice;
    }

    /**
     * Set is3dPrice.
     *
     * @param float $is3dPrice
     *
     * @return Cinema
     */
    public function setIs3dPrice($is3dPrice)
    {
        $this->is3dPrice = $is3dPrice;

        return $this;
    }

    /**
     * Get is3dPrice.
     *
     * @return float
     */
    public function getIs3dPrice()
    {
        return $this->is3dPrice;
    }
}
