<?php

class modele
{
    private $connexion = null;

    public function __construct()
    {
        $this->connexion = new PDO('mysql:host=127.0.0.1;dbname=api_muscu_copy_teach',"root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public function getExerciceByMuscle($IDmuscle) {
        $requetePreparee = $this->connexion->prepare(
            'SELECT * FROM exercice INNER JOIN exercice_muscle ON exercice.id = exercice_muscle.exercice_id 
         INNER JOIN muscle ON muscle.id = exercice_muscle.muscle_id 
         WHERE muscle_id = :paramIDmuscle');
        $requetePreparee->bindParam('paramIDmuscle',$IDmuscle);
        $requetePreparee->execute();
        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }
}