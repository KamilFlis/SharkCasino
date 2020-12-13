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
            $user["surname"]
        );

    }
}