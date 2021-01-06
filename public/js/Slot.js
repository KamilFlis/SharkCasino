import Reel from "./Reel.js";
import Symbol from "./Symbol.js";

export default class Slot {
  constructor(domElement) {
    Symbol.preload();

    this.currentSymbols = [
      ["pharaoh", "pharaoh", "pharaoh"],
      ["pharaoh", "pharaoh", "pharaoh"],
      ["pharaoh", "pharaoh", "pharaoh"],
      ["pharaoh", "pharaoh", "pharaoh"],
      ["pharaoh", "pharaoh", "pharaoh"]
    ];

    this.nextSymbols = [
      ["pharaoh", "pharaoh", "pharaoh"],
      ["pharaoh", "pharaoh", "pharaoh"],
      ["pharaoh", "pharaoh", "pharaoh"],
      ["pharaoh", "pharaoh", "pharaoh"],
      ["pharaoh", "pharaoh", "pharaoh"]
    ];

    this.container = domElement;

    this.reels = Array.from(this.container.getElementsByClassName("reel")).map(
      (reelContainer, idx) =>
        new Reel(reelContainer, idx, this.currentSymbols[idx])
    );

    this.spinButton = document.querySelector(".spin");
    this.spinButton.addEventListener("click", () => this.spin());
  }

  // get username from $_SESSION variable from server
  async getUsername() {
    const response = await fetch("/getUsername");
    return await response.json();
  }

  async updateMoney(win) {
    const moneyMessage = document.querySelector(".message");
    const moneyValue = parseFloat(moneyMessage.innerHTML.split(" ").slice(-1)[0]);

    let username = null;
    await this.getUsername().then(value => {
      username = value["username"];
    })

    const data = {
      username: username,
      money: moneyValue,
      win: win
    };

    fetch("/getMoney", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(data)
    }).then(r => r.json())
      .then(value => {
      moneyMessage.innerHTML = "Your money: " + value["money"];
    });
  }

  spin() {
    this.onSpinStart();

    this.currentSymbols = this.nextSymbols;
    this.nextSymbols = [
      [Symbol.random(), Symbol.random(), Symbol.random()],
      [Symbol.random(), Symbol.random(), Symbol.random()],
      [Symbol.random(), Symbol.random(), Symbol.random()],
      [Symbol.random(), Symbol.random(), Symbol.random()],
      [Symbol.random(), Symbol.random(), Symbol.random()]
    ];

    return Promise.all(
      this.reels.map((reel) => {
        reel.renderSymbols(this.nextSymbols[reel.idx]);
        return reel.spin();
      })
    ).then(() => this.onSpinEnd());
  }

  checkIfWon() {
    for(let i = 0; i < 3; i++) {
      let countSame = 0;
      const value = this.nextSymbols[0][i];
      for (let j = 0; j < 5; j++) {
        if (this.nextSymbols[i][j] === value) {
          countSame++;
          if (countSame === 5) {
            return true;
          }
        }
      }
    }
    return false;
  }

  onSpinStart() {
    this.spinButton.disabled = true;
  }

  onSpinEnd() {
    const win = this.checkIfWon();
    this.updateMoney(win);
    this.spinButton.disabled = false;
  }
}