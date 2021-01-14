<?php


class Address {

    private int $flatNumber;
    private string $street;
    private int $postcode;
    private int $cityId;

    public function __construct(int $flatNumber, string $street, int $postcode, int $cityId) {
        $this->flatNumber = $flatNumber;
        $this->street = $street;
        $this->postcode = $postcode;
        $this->cityId = $cityId;
    }

    public function getFlatNumber(): int {
        return $this->flatNumber;
    }

    public function setFlatNumber(int $flatNumber): void {
        $this->flatNumber = $flatNumber;
    }

    public function getStreet(): string {
        return $this->street;
    }

    public function setStreet(string $street): void {
        $this->street = $street;
    }

    public function getPostcode(): int {
        return $this->postcode;
    }

    public function setPostcode(int $postcode): void {
        $this->postcode = $postcode;
    }

    public function getCityId(): int {
        return $this->cityId;
    }

    public function setCityId(int $cityId): void {
        $this->cityId = $cityId;
    }




}