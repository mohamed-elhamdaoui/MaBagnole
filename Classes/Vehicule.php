<?php

class Vehicule
{

    private $id;
    private $marque;
    private $modele;
    private $prix_journalier;
    private $image_url;
    private $categorie_id;
    private $transmission; // Auto ou Manuelle
    private $carburant;     // Diesel, Essence, Électrique
    private $nb_places;
    private $disponible;
    private $description;

    // Constructeur
    public function __construct($marque, $modele, $prix, $image, $cat_id, $transmission, $carburant, $places, $description, $dispo = true, $id = null)
    {
        $this->id = $id;
        $this->marque = $marque;
        $this->modele = $modele;
        $this->prix_journalier = $prix;
        $this->image_url = $image;
        $this->categorie_id = $cat_id;
        $this->transmission = $transmission;
        $this->carburant = $carburant;
        $this->nb_places = $places;
        $this->disponible = $dispo;
        $this->description = $description;
    }

    // --- GETTERS ---
    public function getId()
    {
        return $this->id;
    }
    public function getMarque()
    {
        return $this->marque;
    }
    public function getModele()
    {
        return $this->modele;
    }
    public function getPrixJournalier()
    {
        return $this->prix_journalier;
    }
    public function getImageUrl()
    {
        return $this->image_url;
    }
    public function getCategorieId()
    {
        return $this->categorie_id;
    }
    public function getTransmission()
    {
        return $this->transmission;
    }
    public function getCarburant()
    {
        return $this->carburant;
    }
    public function getNbPlaces()
    {
        return $this->nb_places;
    }
    public function getDisponible()
    {
        return $this->disponible;
    }

    public function getDescription()
    {
        return $this->description;
    }


    // --- SETTERS ---
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }
    public function setModele($modele)
    {
        $this->modele = $modele;
    }
    public function setPrixJournalier($prix)
    {
        $this->prix_journalier = $prix;
    }
    public function setImageUrl($image)
    {
        $this->image_url = $image;
    }
    public function setDisponible($bool)
    {
        $this->disponible = $bool;
    }


    public function setDescription($desc)
    {
        $this->description = $desc;
    }

    // MÉTHODES  

    // Exemple : Méthode pour récupérer les voitures en vedette (statique)
    public static function getFeaturedVehicles()
    {
        $db = DbConnection::getConnection();
        $sql = "SELECT * FROM vehicules WHERE disponible = 1 LIMIT 3";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addVehicule()
    {

        $pdo = DbConnection::getConnection();

        $sql = "INSERT into vehicules (marque,modele,prix_par_jour,image,categorie_id,transmission,carburant,nb_places,description) 
        values (?,?,?,?,?,?,?,?,?) ";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->marque, $this->modele, $this->prix_journalier, $this->image_url, $this->categorie_id, $this->transmission, $this->carburant, $this->nb_places, $this->description]);
    }


    public static function getAllVehicules()
    {
        $pdo = DbConnection::getConnection();
        $sql = "SELECT * from vehicules where is_active = 1 order by id";

        $result = $pdo->query($sql);

        $arr = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $arr[] = new Vehicule(
                $row["marque"],
                $row["modele"],
                $row["prix_par_jour"],
                $row["image"],
                $row["categorie_id"],
                $row["transmission"],
                $row["carburant"],
                $row["nb_places"],
                $row["description"],
                $row["is_active"],
                $row["id"]

            );
        }

        return $arr;
    }


    public function updateVeh()
    {
        $sql = "UPDATE vehicules set marque = ? , modele = ? ,prix_par_jour = ? , image = ? , categorie_id = ? ,transmission = ?  , carburant = ? , nb_places = ? , description = ? where id = ?  ";
        $conn = DbConnection::getConnection();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$this->marque, $this->modele, $this->prix_journalier, $this->image_url, $this->categorie_id, $this->transmission, $this->carburant, $this->nb_places, $this->description, $this->id]);
    }


    public static function deleteById($id)
    {
        $sql = "DELETE FROM vehicules WHERE id = ?";
        $conn = DbConnection::getConnection();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public static function softDeleteById($id)
    {
        $sql = "UPDATE vehicules SET is_active = 0 WHERE id = ?";
        $conn = DbConnection::getConnection();
        $stmt = $conn->prepare($sql);

        return $stmt->execute([$id]);
    }

    public static function countByCategorie($categorieId)
    {
        $pdo = DbConnection::getConnection();

        $sql = "SELECT COUNT(*) 
            FROM vehicules 
            WHERE categorie_id = ? 
              AND is_active = 1";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$categorieId]);

        return (int) $stmt->fetchColumn();
    }


    public function getByCategoire($catId)
    {
        $sql = "SELECT * from vehicules where categorie_id = ?";
        $db = DbConnection::getConnection();

        $stmt = $db->prepare($sql);
        $stmt->execute([$catId]);

        $arr = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $arr[] = new Vehicule($row["marque"], $row["modele"], $row["prix_par_jour"], $row["image"], $row["categorie_id"], $row["transmission"], $row["carburant"], $row["nb_places"], $row["description"], $row["is_active"]);
        }

        return $arr;
    }


    public static function findVehById($id){
        $sql = "SELECT * from vehicules where id = ?";
        $db = DbConnection::getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $v = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($v);
        
        return  new Vehicule($v["marque"],modele: $v["modele"],prix: $v["prix_par_jour"],image: $v["image"],cat_id: $v["categorie_id"],transmission: $v["transmission"],carburant: $v["carburant"],places: $v["nb_places"],description: $v["description"],dispo: $v["is_active"], id: $v["id"]);

        
    }
}
