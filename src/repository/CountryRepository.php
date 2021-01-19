<?php

require_once "Repository.php";
require_once __DIR__."/../models/Country.php";

class CountryRepository extends Repository {

    public function addCountry(Country $country): void {
        $statement = $this->database->connect()->prepare("
                INSERT INTO public.countries (name) VALUES (?);
        ");

        $statement->execute([$country->getName()]);
    }

    public function getCountry(int $id): ?Country {
        $statement = $this->database->connect()->prepare("
                SELECT * FROM public.countries WHERE id = :id;
        ");

        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $country = $statement->fetch(PDO::FETCH_ASSOC);

        if($country == false) {
            return null;
        }

        return new Country($country["name"]);
    }

    public function getCountryId(Country $country): ?int {
        $statement = $this->database->connect()->prepare("
                SELECT * FROM public.countries WHERE name = ?;
        ");

        $statement->execute([$country->getName()]);
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data["id"];
    }

    public function getAllCountries() {
        $statement = $this->database->connect()->prepare("
                SELECT name FROM public.countries;
        ");

        $statement->execute();


        $countries =  $statement->fetchAll(pdo::FETCH_ASSOC);
//        var_dump($countries);
        return $countries;

//        foreach($countries as $country) {
//            foreach($country as $countryName) {
//                echo $countryName."\n";
//            }
//        }

//        echo $countries;
    }
}