<?php


namespace Src;


class UniqueId
{
    private string $uid;

    public function __construct(string $uid = null)
    {
        if ($uid === null) {
            $microtimeStart = $this->getMicrotime();
            $random = $this->getRandomInteger();
            $this->uid = $microtimeStart . $random;
        } else {
            $this->uid = $uid;
        }
    }

    public function toString(): string
    {
        return (string)$this;
    }

    public function __toString(): string
    {
        return $this->uid;
    }

    public function getMicrotime(): int
    {
        $microtime = (string)microtime(false);
        $microtime = str_replace(['.', ' '], '', $microtime);
        return (int)$microtime;
    }

    public function getRandomInteger(): int
    {
        return random_int(10000000, 99999999);
    }
}