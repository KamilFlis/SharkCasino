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

  updateMoney() {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "slotsHandler.php", true);
    xmlhttp.send();



    // $.ajax({
    //   type: "POST",
    //   data: {
    //     id: 1,
    //     amount: 10
    //   },
    //   url: "../../src/controllers/slotsHandler.php",
    //   dataType: "html",
    //   async: false,
    //   success: function(data) {
    //     result=data;
    //   }
    // });

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


    // take money from wallet
    this.updateMoney();
    let won = this.checkIfWon();
    // put money in wallet
    if(won) {

    }

    return Promise.all(
      this.reels.map((reel) => {
        reel.renderSymbols(this.nextSymbols[reel.idx]);
        return reel.spin();
      })
    ).then(() => this.onSpinEnd());
  }

  checkIfWon() {
    for(let k = 0; k < 3; k++) {
      let countSame = 0;
      const value = this.nextSymbols[0][k];
      for (let i = 0; i < 5; i++) {
        if (this.nextSymbols[k][i] === value) {
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

    console.log("SPIN START");
  }

  onSpinEnd() {
    this.spinButton.disabled = false;

    console.log("SPIN END");

  }
}