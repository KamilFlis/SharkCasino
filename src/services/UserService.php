<?php

require_once __DIR__."/../models/User.php";
require_once __DIR__."/../models/PrivilegedUser.php";
require_once  __DIR__."/../repository/UserRepository.php";
require_once  __DIR__."/../repository/WalletRepository.php";
require_once  __DIR__."/../repository/RoleRepository.php";
require_once "AddressService.php";

class UserService {

    private UserRepository $userRepository;
    private WalletRepository $walletRepository;
    private AddressRepository $addressRepository;
    private RoleRepository $roleRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->walletRepository = new WalletRepository();
        $this->addressRepository = new AddressRepository();
        $this->roleRepository = new RoleRepository();
    }

    public function getWalletAmountByUsername(string $username): float {
        return $this->userRepository->getWalletAmountByUsername($username);
    }

    public function setWalletAmountByUsername(string $username, $amount) {
        $wallet_id = $this->userRepository->getUser($username)->getWalletId();
        $this->walletRepository->updateAmount($wallet_id, $amount);
    }

    public function addUser(string $username, string $email, string $password, string $name,
                            string $surname, string $phoneNumber, int $flatNumber, string $street, int $postcode,
                            string $cityName, string $countryName, string $bankAccountNumber) {

        $addressService = new AddressService();
        $address = $addressService->addAddress($flatNumber, $street, $postcode, $cityName, $countryName);
        $addressId = $this->addressRepository->getAddressId($address);

        $wallet = new Wallet();
        $this->walletRepository->addWallet($wallet);
        $wallet_id = $this->walletRepository->getWalletId($wallet);

        $user = new User($username, $email, $password, $name, $surname, $phoneNumber, $bankAccountNumber, $wallet_id, $addressId);
        $this->userRepository->addUser($user);

        // add 'user' role for user
        $userId = $this->userRepository->getUserId($username);
        $this->roleRepository->assignDefaultRole($userId);
    }

    public function getUser(string $username): ?PrivilegedUser {
        $user = $this->userRepository->getUser($username);
        if($user == null) {
            return null;
        }

        $userId = $this->userRepository->getUserId($username);
        $roles = $this->roleRepository->getRolesForUser($userId);

        return PrivilegedUser::create($user, $roles);
    }

    public function getAllUsers() {
        return $this->userRepository->getAllUsers();
    }

}