<?php
include_once "../../config.php";
include '../../model/User.php';


class userC
{
  function ajouterUser($user)
  {
      $sql ="INSERT INTO utilisateur(nom, prenom, email, password) VALUES (:nom,:prenom,:email,:password)";
      $db = Database::getConnexion(); 
      try{
          $query =$db ->prepare($sql);
          
         // $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);

          $query->execute([
              'nom' => $user->getNom(),
              'prenom' => $user->getPrenom(),
              'email' => $user->getEmail(),
              'password' =>$user->getPassword()
              //'password' =>$hashedPassword 
          ]);
      }catch(Exception $e)
      {
          die('Erreur: '.$e->getMessage());
      }
  }



  function afficherUserC()
  {
      $sql ="SELECT * FROM utilisateur";
      $db = Database::getConnexion(); 
      try{
          $liste =$db ->query($sql);
          return $liste;
      }catch(Exception $e)
      {
          die('Erreur: '.$e->getMessage());
      }
      
  }


  function ModifierUser($user,$id)
  {
       $sql = "UPDATE utilisateur SET nom=:nom ,prenom=:prenom ,email=:email ,password=:password   WHERE id=:id";

       $db = Database::getConnexion(); 
      try{
          $query =$db ->prepare($sql);
          $query->execute([
              'nom' => $user->getNom(),
              'prenom' => $user->getPrenom(),
              'email' => $user->getEmail(),
              'password' => $user->getPassword(),
              'id' =>$id 
          ]);
      }catch(Exception $e)
      {
          die('Erreur: '.$e->getMessage());
      }
  }
  function updateadmin($role,$id)
  {
       $sql = "UPDATE utilisateur SET role=:role WHERE id=:id";

       $db = Database::getConnexion(); 
      try{
          $query =$db ->prepare($sql);
          $query->execute([
              'role' =>$role,
              'id' =>$id 
          ]);
      }catch(Exception $e)
      {
          die('Erreur: '.$e->getMessage());
      }
  }
  /* function updatepassword($email)
  {
       $sql = "UPDATE utilisateur SET password='0000' WHERE email=:email";

       $db= config::getConnexion();
      try{
          $query =$db ->prepare($sql);
          $query->execute([
              'email' =>$email
              
          ]);
      }catch(Exception $e)
      {
          die('Erreur: '.$e->getMessage());
      }
  } */

  
       function SupprimerAdmin($id)
     {
           $sql="DELETE FROM utilisateur WHERE id='$id'";

           $db = Database::getConnexion(); 
           
           try
        {
            $req=$db->prepare($sql);
               $req->execute();
           }
           catch (Exception $e)
        {
               die('Erreur: '.$e->getMessage());
           }
       }

     function RechercherUtilisateur($id)
     {

        $db = Database::getConnexion(); 

     $sql = "SELECT * FROM utilisateur where id='$id'";
     $query=$db->prepare($sql);
     $query->execute();
     }
     function Rechercherid($email,$password)
     {

        $db = Database::getConnexion(); 

     $sql = "SELECT * FROM utilisateur where email='$email'and password='$password'";
     try{
     $query=$db->prepare($sql);
     $query->execute();
     $count=$query->rowCount();
         if($count==0)
         {
             $message="pseudo ou le mot de passe est incorrect";
         }
         else
         {
            $liste=$query->fetch();
            return $liste;
         }
     }
        catch (Exception $e)
        {
               die('Erreur: '.$e->getMessage());
           }
           
     
     }

     function connexionUser($email,$password)
     {
         $sql="SELECT * from utilisateur where email='".$email."'and password='".$password."'";
         $db = Database::getConnexion(); 
         try{
         $query =$db ->prepare($sql);
         $query->execute();
         $count=$query->rowCount();
         if($count==0)
         {
             $message="pseudo ou le mot de passe est incorrect";
         }
         else
         {
             $x=$query->fetch();
             $message=$x['role'];
         }
        }
        catch (Exception $e)
        {
               die('Erreur: '.$e->getMessage());
           }
           return $message;
     }
     function user($id)
     {
        $sql ="SELECT * FROM utilisateur where id='$id'";
        $db = Database::getConnexion(); 
        try{
            $query=$db->prepare($sql);
         $query->execute();
         $count=$query->rowCount();
         if($count==0)
         {
             $message="pseudo ou le mot de passe est incorrect";
         }
         else
         {
            $liste=$query->fetch();
            return $liste;
         }
        }catch(Exception $e)
        {
            die('Erreur: '.$e->getMessage());
        }
     }


     public function afficherAdminRech(string $rech1,string $selon)
     {
         $sql="select * from utilisateur where $selon like '".$rech1."%'";
         
         $db = Database::getConnexion(); 
         try{
             $liste = $db->query($sql);
             return $liste;
         }
         catch(Exception $e){
             die('Erreur: '.$e->getMessage());
         }
     }


     public function afficherAdminDetail(int $rech1)
    {
        $sql="select * from utilisateur where id=".$rech1."";
        
        $db = Database::getConnexion(); 
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }


    function afficherAdminTrie(string $selon)
    {
        $sql="select * from utilisateur order by ".$selon."";
        $db = Database::getConnexion(); 
        try{
            $liste= $db->query($sql);
            return $liste;
    }
    catch(Exception $e){
        die('Erreur: '.$e->getMessage());

    }
    }


    function searchLogin($email,$password){
        $sql="select * from utilisateur where email='$email' AND password='$password'";
        $db = Database::getConnexion(); 
        try{
            $liste = $db->query($sql);
            return $liste;
    }
    catch(Exception $e){
        echo 'Erreur: '.$e->getMessage();
    }
    }


   public function setConn($email,$password)
{
    $sql="update utilisateur set token='ON' where email='$email' AND password='$password'";
    
    $db = Database::getConnexion(); 
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch(Exception $e){
        die('Erreur: '.$e->getMessage());
    }
}


//tbalbiz

function Rechercheridd($email, $password)
{
    $db = Database::getConnexion(); 
    $sql = "SELECT * FROM utilisateur WHERE email LIKE :email AND password = :password";

    try {
        $query = $db->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        $count = $query->rowCount();

        if ($count == 0) {
            $message = "pseudo ou le mot de passe est incorrect";
        } else {
            $liste = $query->fetch();
            if (strpos($email, '@admin') !== false) {
                return $liste;
            } else {
                $message = "Vous n'avez pas les autorisations nécessaires pour vous connecter.";
            }
        }

        return $message;
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}


function modifierAdmin($id, $user) {
    $sql = "UPDATE utilisateur SET nom=:nom, prenom=:prenom, email=:email, password=:password WHERE id=:id";
    $db = Database::getConnexion(); 
    try {
        $query = $db->prepare($sql);

        $query->execute([
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'id' => $id
        ]);
    } catch (Exception $e) {
        // Log the error instead of directly outputting it
        error_log('Erreur: ' . $e->getMessage());
        // Optionally, you can throw the exception again to propagate it to the caller
        // throw $e;
    }
}


function connexionUser1($email, $password)
{
    $db = Database::getConnexion(); 
    $req = $db->prepare('SELECT * FROM utilisateur WHERE email = :email');
    $req->execute(array(
        'email' => $email
    ));
    $result = $req->fetch();
    if ($result && password_verify($password, $result['password'])) {
        return 'connexion réussie';
    } else {
        return 'pseudo ou le mot de passe est incorrect';
    }
}


public function getUserByEmail($email) {
    try {
        $config = new database();
        $conn = $config->getConnexion();
        
        $query = "SELECT * FROM utilisateur WHERE email = :email";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $user;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}


public function updateUserToken($id, $token) {
    try {
        $config = new database();
        $conn = $config->getConnexion();
        
        $query = "UPDATE utiliateur SET token = :token WHERE id = :id";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}




public function updatePassword($id, $password) {
    try {
        $config = new database();
        $conn = $config->getConnexion();

        // You should never store passwords in plain text in a production environment
        // This is just for demonstration purposes
        $query = "UPDATE utilisateur SET password = :password, token = NULL WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':password', $password); // Store the plain text password

        $stmt->execute();
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}


public function updateResetToken($email, $token) {
    try {
        $config = new database();
        $conn = $config->getConnexion();
        
        $query = "UPDATE utilisateur SET token = :token WHERE email = :email";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}


public function getUserByToken($token) {
    try {
        $config = new database();
        $conn = $config->getConnexion();
        
        // Ensure that the token column exists in your user table
        $query = "SELECT * FROM utilisateur WHERE token = :token";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        
        // Fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Check if a user was found with the provided token
        if ($user) {
            return $user;
        } else {
            return false; // No user found with the provided token
        }
    } catch(PDOException $e) {
        // Log the error instead of echoing it
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}




    public function blockUser($id)
    {
        try {
            $config = new database();
            $conn = $config->getConnexion();
            // Prepare the SQL statement
            $query ="UPDATE utilisateur SET bloque = 1 WHERE id = :id";
            $stmt = $conn->prepare($query);
            // Bind the parameter
            $stmt->bindParam(':id', $id);

            // Execute the statement
            $stmt->execute();
        } catch (PDOException $e) {
            // If an error occurs, throw an exception
            throw new Exception("Error blocking user: " . $e->getMessage());
        }
    }



   
    public function unblockUser($id)
    {
        try {
            $config = new database();
            $conn = $config->getConnexion();
            // Prepare the SQL statement
            $query ="UPDATE utilisateur SET bloque = 1 WHERE id = :id";
            $stmt = $conn->prepare($query);
            // Bind the parameter
            $stmt->bindParam(':id', $id);

            // Execute the statement
            $stmt->execute();
        } catch (PDOException $e) {
            // If an error occurs, throw an exception
            throw new Exception("Error blocking user: " . $e->getMessage());
        }
    }
}





























 ?>
