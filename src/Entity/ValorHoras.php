<?php

namespace App\Entity;

use App\Repository\ValorHorasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ValorHorasRepository::class)
 */
class ValorHoras
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $hora_extra;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $detalle;

    /**
     * @ORM\OneToMany(targetEntity=HorasExtra::class, mappedBy="valor_horas", orphanRemoval=true)
     */
    private $horasExtras;

    public function __construct()
    {
        $this->horasExtras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraExtra(): ?int
    {
        return $this->hora_extra;
    }

    public function setHoraExtra(int $hora_extra): self
    {
        $this->hora_extra = $hora_extra;

        return $this;
    }

    public function getDetalle(): ?string
    {
        return $this->detalle;
    }

    public function setDetalle(string $detalle): self
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * @return Collection|HorasExtra[]
     */
    public function getHorasExtras(): Collection
    {
        return $this->horasExtras;
    }

    public function addHorasExtra(HorasExtra $horasExtra): self
    {
        if (!$this->horasExtras->contains($horasExtra)) {
            $this->horasExtras[] = $horasExtra;
            $horasExtra->setValorHoras($this);
        }

        return $this;
    }

    public function removeHorasExtra(HorasExtra $horasExtra): self
    {
        if ($this->horasExtras->removeElement($horasExtra)) {
            // set the owning side to null (unless already changed)
            if ($horasExtra->getValorHoras() === $this) {
                $horasExtra->setValorHoras(null);
            }
        }

        return $this;
    }
}
