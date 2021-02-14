<?php

namespace lShamanl\Parser\Classes\Entity;

class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $phone;
    /**
     * @var string
     */
    private $email;

    public function __construct(int $id, string $name, string $url, string $phone, string $email)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->url   = $url;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function toArray(): array
    {
        return [
            $this->id,
            $this->name,
            $this->url,
            $this->phone,
            $this->email,
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}