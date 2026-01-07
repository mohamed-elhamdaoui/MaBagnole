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
        $this->id = $id;
        $this->user_id = $user_id;
        $this->vehicule_id = $vehicule_id;
        $this->commentaire = $commentaire;
        $this->is_deleted = $is_deleted;
        $this->note = $note;
    }

    public static function getAllAvis()
    {
        $pdo = DbConnection::getConnection();
        $sql = "SELECT a.* , u.nom , u.prenom , v.marque , v.modele from avis a join users u on a.user_id = u.id join vehicules v on a.vehicule_id = v.id where is_deleted = 'false' order by created_at desc ";
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

    public static function getByUserId($userId)
    {
        $pdo = DbConnection::getConnection();


        $sql = "SELECT a.*, v.marque, v.modele 
                FROM avis a 
                JOIN vehicules v ON a.vehicule_id = v.id 
                WHERE a.user_id = ? 
                ORDER BY a.created_at DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterAvis()
    {
        $db = DbConnection::getConnection();
        $sql = "INSERT into avis (user_id ,vehicule_id,note,commentaire ) values (?,?,?,?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$this->user_id, $this->vehicule_id, $this->note, $this->commentaire]);
    }


    public static function getAllAvisByCar($id_car)
    {
        $pdo = DbConnection::getConnection();
        $sql = "SELECT a.* , u.nom , u.prenom , v.marque , v.modele from avis a join users u on a.user_id = u.id join vehicules v on a.vehicule_id = v.id where is_deleted = 'false' AND v.id = ? order by created_at desc ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_car]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
