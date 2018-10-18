<?php

namespace Fssp\Subject;

class Physical implements SubjectInterface
{
    const CODE = 'physical';
    const TYPE = 1;
    private $region;
    private $firstname;
    private $lastname;
    private $secondname;
    private $birthday;

    /**
     * Physical constructor.
     * @param $region
     * @param $firstname
     * @param $lastname
     * @param string $secondname
     * @param \DateTime|null $birthday
     */
    public function __construct($region, $firstname, $lastname, $secondname = '', \DateTime $birthday = null)
    {
        $this->region = $region;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->secondname = $secondname;
        if ($birthday) {
            $this->birthday = $birthday;
        }
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
        $this->firstname = trim($this->firstname);
        $this->lastname = trim($this->lastname);
        $this->secondname = trim($this->secondname);
        return ($this->region && $this->firstname && $this->lastname);
    }

    public function params(): array
    {
        return [
            'region' => $this->region,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'secondname' => $this->secondname,
            'birthday' => $this->birthday ? $this->birthday->format('d.m.Y') : '',
        ];
    }
}