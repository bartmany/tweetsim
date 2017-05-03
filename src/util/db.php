<?php

class db { //tworzymy klasę DB która będzie tworzyć obiekt połączenia z DB
    private $host = null; //ustawiamy własności
    private $user = null;//--
    private $pass = null;//--

    public $conn = null;//--

    public function __construct($host = "127.0.0.1:3306", $user = "root", $pass = "1234"){//tworzymy konstruktor przyjmujący argumenty
        $this->host = $host; //zmieniamy własności
        $this->user = $user;//--
        $this->pass = $pass;//--

        try {
            $this->conn = new PDO("mysql:host=$host", $user, $pass, [ //do wlasnosci conn przypisujemy połączenie z DB
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (Exception $e) {
            echo "Uwaga: " . $e->getMessage() . "\n";
        } //prewencyjnie robimy tryCatch
    }

    public function changeDB($name){ //tworzymy funkcję zmiany DB
        try { //prewencyjnie tryCatch
            $this->conn->exec("use $name"); //na wlasnosci połączenia używamy kwerendy USE (nazwa DB przekazana w argumencie)
        } catch (Exception $e) {
            echo "Uwaga: " . $e->getMessage() . "\n";
            return false; //jeżeli się nie powiedzie zwróć false
        }
        return true; //jeżeli OK
    }
}
