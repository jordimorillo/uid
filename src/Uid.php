<?php


namespace JordiMorillo;


class Uid
{
    private string $uid;

    public function __construct(string $uid = null)
    {
        if ($uid === null) {
            $this->uid = $this->getObjectIdentifier() . $this->getObjectHashAsInteger() . $this->getMicrotime();
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

    public function getObjectHashAsInteger(): int
    {
        return hexdec(spl_object_hash($this));
    }

    public function getObjectIdentifier(): int
    {
        return spl_object_id($this);
    }
}