<?php


class PrivilegedUser extends User {

    private $roles;

    public function __construct(string $username, string $email, string $password, string $name, string $surname, string $phoneNumber, string $bankAccountNumber, int $walletId, int $addressId, $roles) {
        parent::__construct($username, $email, $password, $name, $surname, $phoneNumber, $bankAccountNumber, $walletId, $addressId);
        $this->roles = $roles;
    }

    // way to overload constructor
    public static function create(User $user, $roles): PrivilegedUser {
        return new self(
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getName(),
            $user->getSurname(),
            $user->getPhoneNumber(),
            $user->getBankAccountNumber(),
            $user->getWalletId(),
            $user->getAddressId(),
            $roles
        );
    }

    public function hasPrivilege($permission): bool {
        foreach($this->roles as $role) {
            if($role->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

}