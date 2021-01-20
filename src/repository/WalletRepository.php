<?php

require_once "Repository.php";
require_once __DIR__."/../models/Wallet.php";

class WalletRepository extends Repository {

    public function getWallet(int $walletId): ?Wallet {
        $statement = $this->database->connect()->prepare("SELECT * FROM public.wallets WHERE id = ?");
        $statement->bindParam(1, $walletId, PDO::PARAM_INT);
        $statement->execute();

        $wallet = $statement->fetch(PDO::FETCH_ASSOC);

        if($wallet == false) {
            return null;
        }

        return new Wallet($wallet["amount"]);
    }

    public function updateAmount(int $walletId, $amount) {
        $statement = $this->database->connect()->prepare("UPDATE public.wallets SET amount = ? WHERE id = ?;");
        $statement->bindParam(1, $amount, PDO::PARAM_INT);
        $statement->bindParam(2, $walletId);
        $statement->execute();
    }

    public function addWallet(Wallet $wallet): void {
        $statement = $this->database->connect()->prepare("INSERT INTO public.wallets (amount) VALUES (?);");
        $statement->execute([$wallet->getAmount()]);
    }

    public function getWalletId(Wallet $wallet): ?int {
        $statement = $this->database->connect()->prepare("
                SELECT * FROM public.wallets WHERE amount = ? ORDER BY id DESC LIMIT 1;
        ");
        $statement->execute([$wallet->getAmount()]);

        $data = $statement->fetch(PDO::FETCH_ASSOC);
        if($data == false) {
            return null;
        }

        return $data["id"];
    }


}