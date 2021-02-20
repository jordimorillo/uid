<?php


namespace Src;


class UniqueId
{
    private string $microtimeStart;
    private int $random;

    public function __construct()
    {
        $this->microtimeStart = $this->getMicrotime();
        $this->random = $this->getRandomInteger();
    }

    public function toString(): string
    {
        return (string) $this;
    }

    public function __toString(): string
    {
        return $this->microtimeStart . $this->random;
    }

    public function getMicrotime(): string
    {
        $microtime = (string)microtime(false);
        $microtime = str_replace(['.', ' '], '', $microtime);
        return $microtime;
    }

    public function getRandomInteger(): int
    {
        return random_int(10000000, 99999999);
    }
}