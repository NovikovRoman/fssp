<?php

namespace Fssp\Subject;

interface SubjectInterface
{
    public function type(): int;

    public function code(): string;

    public function isValid(): bool;

    public function params(): array;
}