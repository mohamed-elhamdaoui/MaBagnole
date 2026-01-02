<?php

class Utilisateur
{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $role;


    public function __construct($nom, $prenom, $email, $password, $role = 'client')
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRole()
    {
        return $this->role;
    }
    // public function getIsActive() {
    //     return $this->isactive;
    // }


    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    // public function setIsActive($isactive){
    //     $this->isactive = $isactive;
    // }


    public function seConnecter($email, $password)
    {
        $pdo = DbConnection::getConnection();
        $sql = "SELECT * from users where email = ? and is_active";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $user = $stmt->fetch();
        if ($user && password_verify(password: $password, hash: $user['password'])) {
            $this->id = $user["id"];
            $this->nom = $user["nom"];
            $this->prenom = $user["prenom"];
            $this->role = $user["role"];
            return true;
        }
        return false ;
    }
    
    public function seDeconnecter() {}
}
