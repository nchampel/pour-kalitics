<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La couleur est obligatoire !")
     * @Assert\Length(min=3, minMessage="La couleur doit contenir au moins 3 caractères")
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le modèle est obligatoire !")
     */
    private $model;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le nombre de sièges est obligatoire !")
     */
    private $seats;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le moteur est obligatoire !")
     */
    private $engine;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dealer", inversedBy="cars")
     */
    private $dealer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): self
    {
        $this->seats = $seats;

        return $this;
    }

    public function getEngine(): ?string
    {
        return $this->engine;
    }

    public function setEngine(string $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    public function getDealer(): ?Dealer
    {
        return $this->dealer;
    }

    public function setDealer(?Dealer $dealer): self
    {
        $this->dealer = $dealer;

        return $this;
    }
}
