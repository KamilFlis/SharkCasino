<?php

require_once "Repository.php";
require_once __DIR__."/../models/City.php";

class CityRepository extends Repository {

    public function addCity(City $city): void {
        $statement = $this->database->connect()->prepare("
                INSERT INTO public.cities (name, country_id) VALUES (?, ?);
        ");

        $statement->execute([
            $city->getName(),
            $city->getCountryId()
        ]);
    }

    public function getCity(int $id): ?City {
        $statement = $this->database->connect()->prepare("
                SELECT * FROM public.cities WHERE id = :id;
        ");

        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $city = $statement->fetch(PDO::FETCH_ASSOC);

        if($city == false) {
            return null;
        }

        return new City($city["name"], $city["country_id"]);
    }

    public function getCityId(City $city): ?int {
        $statement = $this->database->connect()->prepare("
                SELECT * FROM public.cities WHERE name = ? AND country_id = ?;
        ");

        $statement->execute([$city->getName(), $city->getCountryId()]);
        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return $data["id"];
    }
}