<?php

require_once("class.Annonce.php");

class TypeAnnonce extends Annonce {
    private $stage = false;


    // OPERATIONS
    public function TypeAnnonce($stage=false){
        $this->stage=$stage;
    }

    public function getStage(){return $this->stage;}

    public function setStage($stage){$this->stage=$stage;}
}