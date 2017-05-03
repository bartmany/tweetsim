<?php

interface activeRecordInterface { //tworzymy interface definiujący zbiór funkcji które muszą zawierać się w klasie która będzie go implementować
    public function getId();
    public function save();
    public function delete();
    static public function loadAll();
    static public function loadById($id);
}
