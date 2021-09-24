<?php

namespace Fssp\Subject;

use DateTime;

class Physical implements SubjectInterface
{
    const CODE = 'physical';
    const TYPE = 1;
    private $region;
    private $firstname;
    private $lastname;
    private $secondname;
    private $birthdate;

    /**
     * Physical constructor.
     * @param string $lastname
     * @param string $firstname
     * @param string $secondname
     * @param DateTime|null $birthdate
     * @param integer $region
     */
    public function __construct(string $lastname, string $firstname, string $secondname, DateTime $birthdate, int $region)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->secondname = $secondname;
        $this->birthdate = $birthdate;
        $this->region = $region;
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
        $this->firstname = trim($this->firstname);
        $this->lastname = trim($this->lastname);
        $this->secondname = trim($this->secondname);
        return ($this->region && $this->firstname && $this->lastname && $this->birthdate);
    }

    public function params(): array
    {
        return [
            'region' => $this->region,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'secondname' => $this->secondname,
            'birthdate' => $this->birthdate,
        ];
    }
}