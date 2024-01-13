<?php

declare(strict_types=1);

namespace JordiMorillo;

use Exception;

class Uid
{
    private string $uid;

    /**
     * @throws Exception
     */
    public function __construct(string $uid = null)
    {
        if ($uid === null) {
            $this->uid = $this->getObjectIdentifier() . $this->randomInteger() . $this->getMicrotime();
            $this->uid += 10 ** 31;
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
        return number_format($this->uid, 0, '', '');
    }

    public function getMicrotime(): int
    {
        $microtime = (string)microtime();
        $microtime = str_replace(['.', ' '], '', $microtime);
        return (int)$microtime;
    }

    public function getObjectIdentifier(): int
    {
        return spl_object_id($this);
    }

    /**
     * @throws Exception
     */
    public function randomInteger(): int
    {
        return random_int(1000000000, 9999999999);
    }
}