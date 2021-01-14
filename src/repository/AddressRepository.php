<?php

require_once "Repository.php";
require_once __DIR__."/../models/Address.php";

class AddressRepository extends Repository {

    public function addAddress(Address $address) {
        $statement = $this->database->connect()->prepare("
                INSERT INTO public.addresses (flat_number, street, postcode, city_id) 
                VALUES (?, ?, ?, ?);
        ");

        $statement->execute([
            $address->getFlatNumber(),
            $address->getStreet(),
            $address->getPostcode(),
            $address->getCityId()
        ]);
    }

    public function getAddress(int $id): ?Address {
        $statement = $this->database->connect()->prepare("
                SELECT * FROM public.addresses WHERE id = :id;
        ");

        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $address = $statement->fetch(PDO::FETCH_ASSOC);

        if($address == false) {
            return null;
        }

        return new Address($address["flat_number"], $address["street"], $address["postcode"], $address["city_id"]);
    }

    public function getAddressId(Address $address): ?int {
        $statement = $this->database->connect()->prepare("
                SELECT * FROM public.addresses WHERE flat_number = ? AND street = ? AND postcode = ? AND city_id = ?;
        ");

        $statement->execute([
            $address->getFlatNumber(),
            $address->getStreet(),
            $address->getPostcode(),
            $address->getCityId()
        ]);

        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data["id"];
    }
}