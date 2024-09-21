<?php

namespace App\Entity;

use App\Repository\DesinformacionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DesinformacionRepository::class)]
#[ORM\Table(name: 'desinformacion')]
class Desinformacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $titular;

    #[ORM\Column(type: 'text')]
    private string $contenido;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $fechaRegistro;

    #[ORM\Column(type: 'string', length: 100)]
    private string $redSocial;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $multimedia = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $palabrasClave;

    #[ORM\Column(type: 'string', columnDefinition: "ENUM('desmentido', 'no verificable', 'en investigación')")]
    private string $estadoInterno;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $observaciones = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getTitular(): string
    {
        return $this->titular;
    }

    public function setTitular(string $titular): static
    {
        $this->titular = $titular;
        return $this;
    }

    public function getContenido(): string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): static
    {
        $this->contenido = $contenido;
        return $this;
    }

    public function getFechaRegistro(): \DateTimeInterface
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(\DateTimeInterface $fechaRegistro): static
    {
        $this->fechaRegistro = $fechaRegistro;
        return $this;
    }

    public function getRedSocial(): string
    {
        return $this->redSocial;
    }

    public function setRedSocial(string $redSocial): static
    {
        $this->redSocial = $redSocial;
        return $this;
    }

    public function getMultimedia(): ?string
    {
        return $this->multimedia;
    }

    public function setMultimedia(?string $multimedia): static
    {
        $this->multimedia = $multimedia;
        return $this;
    }

    public function getPalabrasClave(): string
    {
        return $this->palabrasClave;
    }

    public function setPalabrasClave(string $palabrasClave): static
    {
        $this->palabrasClave = $palabrasClave;
        return $this;
    }

    public function getEstadoInterno(): string
    {
        return $this->estadoInterno;
    }

    public function setEstadoInterno(string $estadoInterno): static
    {
        $this->estadoInterno = $estadoInterno;
        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): static
    {
        $this->observaciones = $observaciones;
        return $this;
    }
}