<?php

namespace App\Entity;

use App\Repository\HorasExtraRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorasExtraRepository::class)
 */
class HorasExtra
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="horasExtras")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=ValorHoras::class, inversedBy="horasExtras")
     * @ORM\JoinColumn(nullable=false)
     */
    private $valor_horas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $actividad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getValorHoras(): ?ValorHoras
    {
        return $this->valor_horas;
    }

    public function setValorHoras(?ValorHoras $valor_horas): self
    {
        $this->valor_horas = $valor_horas;

        return $this;
    }

    public function getActividad(): ?string
    {
        return $this->actividad;
    }

    public function setActividad(string $actividad): self
    {
        $this->actividad = $actividad;

        return $this;
    }
}
