<?php

require_once __DIR__."/../models/User.php";
require_once  __DIR__."/../repository/UserRepository.php";
require_once  __DIR__."/../repository/WalletRepository.php";

class UserService {

    private UserRepository $userRepository;
    private WalletRepository $walletRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->walletRepository = new WalletRepository();
    }

    public function getWalletAmountByUsername(string $username): float {
        return $this->userRepository->getWalletAmountByUsername($username);
    }

    public function setWalletAmountByUsername(string $username, $amount) {
        $wallet_id = $this->userRepository->getUser($username)->getWalletId();
        $this->walletRepository->updateAmount($wallet_id, $amount);
    }

    public function addUserWithWallet(string $username, string $email, string $password, string $name, string $surname) {
        $wallet_id = $this->walletRepository->addWallet(150);
        if($wallet_id == null) {
            return null;
        }

        $user = new User($username, $email, $password, $name, $surname, $wallet_id);
        $this->userRepository->addUser($user);

    }
}