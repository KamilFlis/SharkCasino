<?php


class Wallet {

    private float $amount;

    public function __construct(float $amount = 0) {
        $this->amount = $amount;
    }

    public function getAmount(): float {
        return $this->amount;
    }

    public function setAmount(float $amount) {
        $this->amount = $amount;
    }




}