<?php

require_once  __DIR__."/../repository/AddressRepository.php";
require_once  __DIR__."/../repository/CityRepository.php";
require_once  __DIR__."/../repository/CountryRepository.php";

class AddressService {

    private AddressRepository $addressRepository;
    private CityRepository $cityRepository;
    private CountryRepository $countryRepository;

    public function __construct() {
        $this->addressRepository = new AddressRepository();
        $this->cityRepository = new CityRepository();
        $this->countryRepository = new CountryRepository();
    }

    // TODO: add some countries to database and change form to select from list
    public function addAddress(int $flatNumber, string $street, int $postcode, $cityName, $countryName): Address {
        $country = new Country($countryName);
        $this->countryRepository->addCountry($country);
        $countryId = $this->countryRepository->getCountryId($country);

        $city = new City($cityName, $countryId);
        $this->cityRepository->addCity($city);
        $cityId = $this->cityRepository->getCityId($city);

        $address = new Address($flatNumber, $street, $postcode, $cityId);
        $this->addressRepository->addAddress($address);

        return $address;
    }

    public function getAddress(string $username) {
        return $this->addressRepository->getAddressView($username);
    }
}