<?php


class City {

    private string $name;
    private int $countryId;

    public function __construct(string $name, int $countryId) {
        $this->name = $name;
        $this->countryId = $countryId;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getCountryId(): int {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): void {
        $this->countryId = $countryId;
    }




}