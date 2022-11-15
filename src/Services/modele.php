<?php

class modele
{
    private $connexion = null;

    public function __construct()
    {
        $this->connexion = new PDO('mysql:host=127.0.0.1;dbname=api_muscu',"root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public function getExerciceByMuscle($IDmuscle) {
        $requetePreparee = $this->connexion->prepare('SELECT * FROM exercice INNER JOIN exercice_muscles ON exercice.id = exercice_muscles.IDexercice WHERE IDmuscle = :paramIDmuscle');
        $requetePreparee->bindParam('paramIDmuscle',$IDmuscle);
        $requetePreparee->execute();
        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }
}