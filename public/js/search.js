async function getUsername() {
    const response = await fetch("/getUsername");
    return await response.json();
}

async function getGeneralData() {
    let username = null;
    await this.getUsername().then(value => {
        username = value["username"];
    });

    const data = { username: username };
    fetch("/getGeneralInfo", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    }).then(r => r.json())
      .then(data => {
          loadGeneralData(data);
      });
}

function loadGeneralData(data) {
    document.querySelector("#name").innerHTML = data["name"];
    document.querySelector("#surname").innerHTML = data["surname"];
    document.querySelector("#email").innerHTML = data["email"];
    document.querySelector("#phoneNumber").innerHTML = data["phoneNumber"];
}

async function getAddressData() {
    let username = null;
    await this.getUsername().then(value => {
        username = value["username"];
    });

    const data = { username: username };
    fetch("/getAddressInfo", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    }).then(r => r.json())
        .then(data => {
            loadAddressData(data);
        });
}

function loadAddressData(data) {
    document.querySelector("#flatNumber").innerHTML = data["flat_number"];
    document.querySelector("#postcode").innerHTML = data["postcode"];
    document.querySelector("#street").innerHTML = data["street"];
    document.querySelector("#city").innerHTML = data["city"];
    document.querySelector("#country").innerHTML = data["country"];
}

async function getWalletData() {
    let username = null;
    await this.getUsername().then(value => {
        username = value["username"];
    });

    const data = { username: username };
    fetch("/getWalletInfo", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    }).then(r => r.json())
        .then(data => {
            document.querySelector("#amount").innerHTML = data["amount"];
        });

}