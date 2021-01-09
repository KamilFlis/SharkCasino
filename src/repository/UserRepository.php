<?php

require_once "Repository.php";
require_once __DIR__."/../models/User.php";

class UserRepository extends Repository {

    public function getWalletAmountByUsername($username): float {
        $statement = $this->database->connect()->prepare("SELECT amount FROM public.users INNER JOIN wallet w ON w.id = users.wallet_id AND username = :username");
        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->execute();

        $wallet = $statement->fetch(PDO::FETCH_NUM);
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
            $user["wallet_id"]
        );
    }

    public function addUser(User $user) {
        $statement = $this->database->connect()->prepare("
                INSERT INTO public.users (username, email, password, name, surname, wallet_id) 
                VALUES (?, ?, ?, ?, ?, ?);
        ");

        $statement->execute([
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getName(),
            $user->getSurname(),
            $user->getWalletId()
        ]);
    }
}