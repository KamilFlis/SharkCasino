<?php


class Wallet {

    private $amount;

    public function __construct(float $amount) {
        $this->amount = $amount;
    }

    public function getAmount(): float {
        return $this->amount;
    }

    public function setAmount(float $amount) {
        $this->amount = $amount;
    }




}