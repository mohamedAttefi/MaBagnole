<?php

class Utilisateur{
    protected $id;
    protected $nom;
    protected $email;
    protected $motPasse;
    protected $telephone;
    protected $adress;
    protected $permisNumero;
    protected $dateInscription;

    public function __construct($nom, $email, $motPasse, $telephone, $adress, $permisNumero, $dateInscription){
        $this->id = null;
        $this->nom = $nom;
        $this->email = $email;
        $this->motPasse = $motPasse;
        $this->telephone = $telephone;
        $this->adress = $adress;
        $this->permisNumero = $permisNumero;
        $this->dateInscription = $dateInscription;
    }

    public function seConnecter(){
        
    }
}