<?php
include_once('src/interface/activeRecord.php'); //załączamy interface

abstract class activeRecord implements activeRecordInterface { //tworzymy klasę abstrakcyjną(nie można z niej stworzyć obiektu) która implementuje interface
    protected $id; //definiujemy własności
    protected static $db; //definiujemy własności
    public function __construct(){ //tworzymy konstruktor
        self::connect(); // wywołujemy funkcje connect = połączenie z DB
        $this->id = -1; //ustawiamy id na -1
    }

    public static function connect(){ //defuniujemy funkcje połączenia z DB (static bo chcemy mieć możliwość wywołania jej bez tworzenia obiektu)
        if(!self::$db){ //jeżeli DB nie jest ustanowione
            self::$db = new db(); //to ustanów nowy obiekt połączenia
            self::$db->changeDB('twitter'); //zmień DB na twitter
        }
        return true; //zwróć true
    }

    public function saveToDb(){} //definiujemy funkcje zapisywania do DB
}
