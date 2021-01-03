<?php

require_once __DIR__."/../models/User.php";
require_once  __DIR__."/../repository/UserRepository.php";
require_once  __DIR__."/../repository/WalletRepository.php";

class UserService {

    /** Get user wallet by username */
    public function getUserWallet(string $username): ?Wallet {
        $userRepository = new UserRepository();
        $user = $userRepository->getUser($username);

        $walletRepository = new WalletRepository();
        return $walletRepository->getWallet($user->getWalletId());
    }
}