<?php

require_once "Repository.php";
require_once __DIR__."/../models/User.php";

class UserRepository extends Repository {

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
        $statement = $this->database->connect()->prepare("INSERT INTO public.users (username, email, password, name, surname, wallet_id) VALUES (:username, :email, :password, :name, :surname, :wallet_id);");
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $name = $user->getName();
        $surname = $user->getSurname();
        $wallet_id = $user->getWalletId();

        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":password", $password, PDO::PARAM_STR);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":surname", $surname, PDO::PARAM_STR);
        $statement->bindParam(":wallet_id", $wallet_id, PDO::PARAM_INT);

        $statement->execute();
    }
}