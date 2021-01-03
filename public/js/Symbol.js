const cache = {};

export default class Symbol {
    constructor(name = Symbol.random()) {
        this.name = name;

        if(cache[name]) {
            this.img = cache[name].cloneNode();
        } else { 
            this.img = new Image();
            this.img.src = `public/img/slotsCleopatra/${name}.png`;
        }

        cache[name] = this.img;
    }

    static preload() {
        Symbol.symbols.forEach((symbol) => new Symbol(symbol));
    }

    static get symbols() {
        return [
            "9",
            "10",
            "a",
            "cleopatra",
            "cockchafer",
            "eye",
            "gold",
            "j",
            "k",
            "pharaoh",
            "q",
            "tools"
        ];
    }

    static random() {
        return this.symbols[Math.floor(Math.random() * this.symbols.length)];
    }
}