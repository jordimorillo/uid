<?php

declare(strict_types=1);

namespace JordiMorillo\Uid;

use Exception;
use Jordimorillo\Uid\Exception\RandomIntegerGenerationException;

class Uid
{
    private float $uid;

    /**
     * @throws RandomIntegerGenerationException
     */
    public function __construct(float $uid = null)
    {
        if ($uid === null) {
            $this->uid = (float) ($this->getObjectIdentifier() . $this->randomInteger() . $this->getMicrotime());
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
     * @throws RandomIntegerGenerationException
     */
    public function randomInteger(): int
    {
        try {
            $randomInteger = random_int(1000000000, 9999999999);
        } catch (Exception $exception) {
            throw new RandomIntegerGenerationException($exception->getMessage());
        }
        return $randomInteger;
    }
}