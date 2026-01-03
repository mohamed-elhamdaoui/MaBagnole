<?php

class Reservation
{
    private $id;
    private $user_id;
    private $vehicule_id;
    private $date_debut;
    private $date_fin;
    private $lieu_prise;
    private $lieu_retour;
    private $statut;
    private $total_prix;

    // Constructeur
    public function __construct($user_id, $vehicule_id, $date_debut, $date_fin, $lieu_prise, $lieu_retour, $statut = 'en_attente', $total_prix = null, $id = null)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->vehicule_id = $vehicule_id;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->lieu_prise = $lieu_prise;
        $this->lieu_retour = $lieu_retour;
        $this->statut = $statut;
        $this->total_prix = $total_prix;
        // $this->created_at = $created_at;
    }

    // --- GETTERS ---
    public function getId()
    {
        return $this->id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getVehiculeId()
    {
        return $this->vehicule_id;
    }
    public function getDateDebut()
    {
        return $this->date_debut;
    }
    public function getDateFin()
    {
        return $this->date_fin;
    }
    public function getLieuPrise()
    {
        return $this->lieu_prise;
    }
    public function getLieuRetour()
    {
        return $this->lieu_retour;
    }
    public function getStatut()
    {
        return $this->statut;
    }
    public function getTotalPrix()
    {
        return $this->total_prix;
    }
    // public function getCreatedAt()
    // {
    //     return $this->created_at;
    // }


    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function setVehiculeId($vehicule_id)
    {
        $this->vehicule_id = $vehicule_id;
    }
    public function setDateDebut($date)
    {
        $this->date_debut = $date;
    }
    public function setDateFin($date)
    {
        $this->date_fin = $date;
    }
    public function setLieuPrise($lieu)
    {
        $this->lieu_prise = $lieu;
    }
    public function setLieuRetour($lieu)
    {
        $this->lieu_retour = $lieu;
    }
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }
    public function setTotalPrix($prix)
    {
        $this->total_prix = $prix;
    }

    public static function getAllDetailed(){

        $pdo = DbConnection::getConnection();
        $sql  = "SELECT r.* , u.nom , u.prenom , u.email , v.modele , v.marque , v.image 
        from reservations r join users u on r.user_id = u.id join vehicules v on r.vehicule_id = v.id 
        ORDER BY r.created_at DESC  ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }





}
