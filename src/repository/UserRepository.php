<?php

require_once "Repository.php";
require_once __DIR__."/../models/User.php";

class UserRepository extends Repository {

    public function getWalletAmountByUsername($username): float {
        $statement = $this->database->connect()->prepare("
            SELECT amount FROM public.users u INNER JOIN public.wallets w ON w.id = u.wallet_id AND u.username = :username
        ");
        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->execute();

        $wallet = $statement->fetch(PDO::FETCH_ASSOC);
        return floatval($wallet["amount"]);
    }

    public function getUser(string $username): ?User {
        $statement = $this->database->connect()->prepare("
            SELECT * FROM public.users WHERE username = :username
        ");

        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user == false) {
            return null;
        }

        return new User(
            $user["username"],
            $user["email"],
            $user["password"],
            $user["name"],
            $user["surname"],
            $user["phone_number"],
            $user["bank_account_number"],
            $user["wallet_id"],
            $user["address_id"]
        );
    }

    public function addUser(User $user) {
        $statement = $this->database->connect()->prepare("
                INSERT INTO public.users (username, email, password, name, surname, phone_number, bank_account_number, wallet_id, address_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);
        ");

        $statement->execute([
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getName(),
            $user->getSurname(),
            $user->getPhoneNumber(),
            $user->getBankAccountNumber(),
            $user->getWalletId(),
            $user->getAddressId()
        ]);
    }

    public function setPassword(string $username, string $password) {
        $statement = $this->database->connect()->prepare("
            UPDATE public.users
            SET password = :password
            WHERE username = :username;
        ");

        $statement->bindParam(":password", $password);
        $statement->bindParam(":username", $username);

        $statement->execute();
    }

    public function checkIfUserParameterExist(string $email, string $phoneNumber, string $bankAccountNumber) {
        $statement = $this->database->connect()->prepare("
                SELECT check_if_user_parameters_exist(:email, :phoneNumber, :bankAccountNumber);
        ");

        $statement->execute([
           ":email" => $email,
           ":phoneNumber" => $phoneNumber,
           ":bankAccountNumber" => $bankAccountNumber
        ]);

        return $statement->fetchColumn(0);
    }

    public function getUserId(string $username) {
        $statement = $this->database->connect()->prepare("
                SELECT id FROM users WHERE username=:username
        ");

        $statement->execute([":username" => $username]);
        return $statement->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function getAllUsers() {
        $statement = $this->database->connect()->prepare("
                SELECT * FROM users;
        ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}