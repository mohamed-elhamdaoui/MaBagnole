<?php

class Categorie
{
    private $id;
    private $nom;
    private $description;

    public function __construct($nom, $description, $id = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    public function setDescription($description)
    {
        $this->description = $description; 
    }

    // Méthode pour récupérer toutes les catégories (utile pour tes <select>)
    public static function getAll()
    {
        $db = DbConnection::getConnection();
        $stmt = $db->query("SELECT * FROM categories ORDER BY nom ASC");
        $arr = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $arr[] = new Categorie($row["nom"],$row["description"],$row["id"]);
        }

        return $arr;
    }
    
}
