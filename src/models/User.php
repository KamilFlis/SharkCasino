<?php


class User {

    private string $username;
    private string $email;
    private string $password;
    private string $name;
    private string $surname;
    private string $phoneNumber;
    private string $bankAccountNumber;
    private int $walletId;
    private int $addressId;

    public function __construct(string $username, string $email, string $password, string $name, string $surname,
                                string $phoneNumber, string $bankAccountNumber, int $walletId, int $addressId) {

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->phoneNumber = $phoneNumber;
        $this->bankAccountNumber = $bankAccountNumber;
        $this->walletId = $walletId;
        $this->addressId = $addressId;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username) {
        $this->username = $username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function setSurname(string $surname) {
        $this->surname = $surname;
    }

    public function getWalletId(): int {
        return $this->walletId;
    }

    public function setWalletId(int $walletId): void {
        $this->walletId = $walletId;
    }

    public function getAddressId(): int {
        return $this->addressId;
    }

    public function setAddressId(int $addressId): void {
        $this->addressId = $addressId;
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void {
        $this->phoneNumber = $phoneNumber;
    }

    public function getBankAccountNumber(): string {
        return $this->bankAccountNumber;
    }

    public function setBankAccountNumber(string $bankAccountNumber): void {
        $this->bankAccountNumber = $bankAccountNumber;
    }



}