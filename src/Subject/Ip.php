<?php

namespace Fssp\Subject;

class Ip implements SubjectInterface
{
    const CODE = 'ip';
    const TYPE = 3;
    private $number;

    public function __construct($number)
    {
        $this->number = $number;
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
        $this->number = trim($this->number);
        return !!($this->number);
    }

    public function params(): array
    {
        return [
            'number' => $this->number,
        ];
    }
}