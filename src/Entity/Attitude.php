<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttitudeRepository")
 */
class Attitude
{
    use TimestampableEntity;

    const NEUTRAL = 'neutral';
    const GOOD = 'good';
    const BAD = 'bad';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public static function getTypes(): array
    {
        return [
            static::NEUTRAL => static::NEUTRAL,
            static::GOOD => static::GOOD,
            static::BAD => static::BAD,
        ];
    }

}
