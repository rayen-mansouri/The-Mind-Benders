<?php
namespace App\Models;
class User
{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $email = null;
    private ?string $login = null;
    private ?string $password = null;
    private ?string $role = null;

    function __construct(string $nom, string $prenom, string $email, string $password)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;    
        $this->password = $password;
    }

    function getId(): ?int // Nullable return type
    {
        return $this->id;
    }
    function getNom(): ?string // Nullable return type
    {
        return $this->nom;
    }
    function getPrenom(): ?string // Nullable return type
    {
        return $this->prenom;
    }
    function getLogin(): ?string // Nullable return type
    {
        return $this->login;
    }
    function getEmail(): ?string // Nullable return type
    {
        return $this->email;
    }
    function getPassword(): ?string // Nullable return type
    {
        return $this->password;
    }
    function getRole(): ?string // Nullable return type
    {
        return $this->role;
    }
    function getToken(): ?string // Nullable return type
    {
        return $this->token;
    }

    function setNom(?string $nom): void // Nullable parameter type
    {
        $this->nom = $nom;
    }
    function setPrenom(?string $prenom): void // Nullable parameter type
    {
        $this->prenom = $prenom;
    }
    function setLogin(?string $login): void // Nullable parameter type
    {
        $this->login = $login;
    }
    function setEmail(?string $email): void // Nullable parameter type
    {
        $this->email = $email;
    }
    function setPassword(?string $password): void // Nullable parameter type
    {
        $this->password = $password;
    }
    function setToken(?string $token): void // Nullable parameter type
    {
        $this->password = $token;
    }
    
}
?>