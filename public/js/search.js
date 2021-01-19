async function getGeneralData() {
    fetch("/getGeneralInfo", {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(r => r.json())
        .then(data => loadGeneralData(data));
}

function loadGeneralData(data) {
    document.querySelector("#name").innerHTML = data["name"];
    document.querySelector("#surname").innerHTML = data["surname"];
    document.querySelector("#email").innerHTML = data["email"];
    document.querySelector("#phoneNumber").innerHTML = data["phoneNumber"];
}

async function getAddressData() {
    fetch("/getAddressInfo", {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(r => r.json())
        .then(data => loadAddressData(data));
}

function loadAddressData(data) {
    document.querySelector("#flatNumber").innerHTML = data["flat_number"];
    document.querySelector("#postcode").innerHTML = data["postcode"];
    document.querySelector("#street").innerHTML = data["street"];
    document.querySelector("#city").innerHTML = data["city"];
    document.querySelector("#country").innerHTML = data["country"];
}

async function getWalletData() {
    fetch("/getWalletInfo", {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(r => r.json())
        .then(data => loadWalletData(data));
}

function loadWalletData(data) {
    document.querySelector("#amount").innerHTML = data["amount"];
}

function getCountries() {
    fetch("/getCountries", {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(r => r.json())
        .then(data => loadCountriesData(data));
}

function loadCountriesData(data) {
    const section = document.querySelector("#country");
    data.forEach(element => {
        const option = document.createElement("option");
        option.value = element["name"];
        option.innerHTML = element["name"];
        section.appendChild(option);
    });
}