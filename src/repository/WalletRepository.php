<?php

require_once "Repository.php";
require_once __DIR__."/../models/Wallet.php";

class WalletRepository extends Repository {

    public function getWallet(int $walletId): ?Wallet {
        $statement = $this->database->connect()->prepare("SELECT * FROM public.wallet WHERE id = ?");
        $statement->bindParam(1, $walletId, PDO::PARAM_INT);
        $statement->execute();

        $wallet = $statement->fetch(PDO::FETCH_ASSOC);

        if($wallet == false) {
            return null;
        }

        return new Wallet($wallet["amount"]);
    }

    public function updateAmount(int $walletId, float $amount) {
        $statement = $this->database->connect()->prepare("UPDATE wallet SET amount = ? WHERE id: ?");
        $statement->bindParam(1, $amount, PDO::PARAM_INT);
        $statement->bindParam(2, $walletId, PDO::PARAM_INT);
        $statement->execute();
    }


}