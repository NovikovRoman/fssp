<?php

namespace Fssp\Subject;

class Legal implements SubjectInterface
{
    const CODE = 'legal';
    const TYPE = 2;
    private $region;
    private $name;
    private $address;

    public function __construct($region, $name, $address = '')
    {
        $this->region = $region;
        $this->name = $name;
        $this->address = $address;
    }

    public function type(): int
    {
        return self::TYPE;
    }

    public function code(): string
    {
        return self::CODE;
    }

    public function isValid(): bool
    {
        $this->region = intval($this->region);
        $this->name = trim($this->name);
        $this->address = trim($this->address);
        return ($this->region && $this->name);
    }

    public function params(): array
    {
        return [
            'region' => $this->region,
            'name' => $this->name,
            'address' => $this->address,
        ];
    }
}