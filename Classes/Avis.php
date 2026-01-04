<?php

class Avis
{
    private $id;
    private $user_id;
    private $vehicule_id;
    private $note;
    private $commentaire;
    private $is_deleted;


    public function __construct($user_id, $vehicule_id, $note, $commentaire, $is_deleted = false, $id = null)
    {
        $this->$id;
        $this->$user_id;
        $this->$vehicule_id;
        $this->$commentaire;
        $this->$is_deleted;
        $this->$note;
    }

    public static function getAllAvis()
    {
        $pdo = DbConnection::getConnection();
        $sql = "SELECT a.* , u.nom , u.prenom , v.marque , v.modele from avis a join users u on a.user_id = u.id join vehicules v on a.vehicule_id = v.id order by created_at desc ";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAvgReviews()
    {
        $pdo = DbConnection::getConnection();

        $stmt = $pdo->query("SELECT AVG(note) AS avg_note FROM avis");

        
        $row = $stmt->fetch();

        return round($row['avg_note'], 1);
    }
}
