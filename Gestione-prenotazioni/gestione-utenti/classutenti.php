<?php

class UserManagement {
  private $PDO;
  
  public function __construct($PDOconn) {
    $this->PDO = $PDOconn;
  }
  
// method to manage and register new users

  public function newUser($uname, $psw, $psw2) {   // new user registration
    //sanification of spaces at the top and at the end and sanitize
    $cleanUser = trim($uname);
    $cleanPassword = trim($psw);
    $cleanPassword2 = trim($psw2);
    $cleanUser = filter_var($cleanUser, FILTER_SANITIZE_STRING);
    // check of the username
    if(!(ctype_alnum($cleanUser) && mb_strlen($cleanUser) >= 3 && mb_strlen($cleanUser) <= 20)) {
      echo "<script>alert('Username troppo lunga o troppo corta!');</script>";
      return false;
    }
    if(!(ctype_alnum($cleanPassword) && mb_strlen($cleanPassword) >= 3 && mb_strlen($cleanPassword) <= 20)) {
      echo "<script>alert('Password troppo lunga o troppo corta!');</script>";
      return false;
    }
    // check if the username is not already present into the DB
    try {
      $query = "SELECT * FROM utenti WHERE (username = :cleanUser)";
      $rq = $this->PDO->prepare($query);
      $rq->bindParam(":cleanUser", $cleanUser, PDO::PARAM_STR);
      $rq->execute();
        if ($rq->rowCount() > 0) {
          echo "<script>alert('Username già presente!');</script>";
          return false;
        }  
    } catch(PDOExecption $e) {
      echo "Errore di estrazione" . $e->getMessage();
      }
      // check of the password
      if(!preg_match('/^[a-zA-Z0-9\+=\!@#\$%]{3,20}$/', $cleanPassword)) {
        echo "<script>alert('Password non valida!');</script>";
        return false;
      }
      // check if password and repeated password are equal
      if(strcmp($cleanPassword, $cleanPassword2) !== 0 ) {
        echo "<script>alert('Password e conferma password non uguali!');</script>";
        return false;
      }
      // check if user name has been provided
      if(mb_strlen($cleanUser) == 0 ) {
        echo "<script>alert('Username non inserita!');</script>";
        return false;
      }
      // encript the password
      $passwordHash = password_hash($cleanPassword, PASSWORD_DEFAULT);
      // now we can launch the query
      try {
        $query = "INSERT INTO utenti (username, password) VALUES (:uname, :password)";
        $rq = $this->PDO->prepare($query);
        $rq->bindParam(":uname", $cleanUser, PDO::PARAM_STR);
        $rq->bindParam(":password", $passwordHash, PDO::PARAM_STR);
        $rq->execute();
        $message = "<h3>Registrazione effettuata</h3>";
        echo $message;
      } catch(PDOException $e) {
          echo "Errore di inserimento nel DB" . $e->getMessage();
      }
      return true;
  }
  
  // method to create the list of users
  
  public function utentiList() {
    try {
      $query = "SELECT utenti.ID, utenti.username FROM utenti";
      $rq = $this->PDO->prepare($query);
      $rq->execute();
    } catch (PDOException $e) {
      echo "Errore di estrazione dati dal DB" . $e->getMessage();
    }
    if($rq->rowCount() == 0 ) {
      echo "<h3>nessun utente in elenco.</h3>";
      } else {
      
      while ($record = $rq->fetch(PDO::FETCH_ASSOC)) {
        $xx = $record['ID'];
        $name = $record['username'];
        echo "<tr>";
        echo "<td class='colored-table'>" . $record['ID'] . "</td>";
        echo "<td class='colored-table'>"  . $record['username'] . "</td>";
        echo "<td class='link_modify'><a href='cambioutente.php?modify={$xx}&name={$name}'> &#9989 </a></td>";
        echo "<td class='link_cancel'><a href='gestioneutenti.php?delete={$xx}'> &#10060 </a></td>";
        echo "</tr>";
        
      }
    } 
  }
  
  // method to manage the delete of the user from the DB
  
  public function cancelUser($userToCancel) {   // here we will cancel the user from the DB with all his/her TO DO
    try { 
    $query = "DELETE FROM utenti WHERE ID = '$userToCancel'"; //$userToCancel is not an input, sanitize not necessary
    $rq = $this->PDO->prepare($query);
    $rq->execute();
    } catch(PDOException $e) {
        echo "Errore di inserimento nel DB" . $e->getMessage();
    }
    try {
    $query = "DELETE FROM utentiloggati WHERE id_logged = '$userToCancel'";
    $rq = $this->PDO->prepare($query);
    $rq->execute();
    } catch(PDOException $e) {
        echo "Errore di inserimento nel DB" . $e->getMessage();
    }
    header('location: gestioneutenti.php');
  }
  
  
  // method to manage the change of the password of the user
  
  public function changePassword($user, $psw, $psw2) {
    //sanification of spaces at the top and at the end
    $cleanPassword = trim($psw);
    $cleanPassword2 = trim($psw2);
    if(!(ctype_alnum($cleanPassword) && mb_strlen($cleanPassword) >= 3 && mb_strlen($cleanPassword) <= 20)) {
      echo "<script>alert('Password troppo lunga lunga o troppo corta!');</script>";
      return false;
    }
    // check of the password
    if(!preg_match('/^[a-zA-Z0-9\+=\!@#\$%]{3,20}$/', $cleanPassword)) {
      echo "<script>alert('Password non valida!');</script>";
      return false;
    }
    // check if password and repeated password are equal
    if(strcmp($cleanPassword, $cleanPassword2) !== 0 ) {
      echo "<script>alert('Password e conferma password non uguali!');</script>";
      return false;
      }
    // encript the password
    $passwordHash = password_hash($cleanPassword, PASSWORD_DEFAULT);
    // now we can launch the query
    try {
    $query = "UPDATE utenti SET password=:password WHERE ID = '$user'"; //$user is not an input, sanitize not necessary
    $rq = $this->PDO->prepare($query);
    $rq->bindParam(":password", $passwordHash, PDO::PARAM_STR);
    $rq->execute();
    header('location: gestioneutenti.php');
    $message = "<h3>Modifica della Password Effettuata!</h3>";
    echo $message;
    } catch(PDOException $e) {
        echo "Errore di inserimento nel DB" . $e->getMessage();
    }
    return true;
  }
  
  // method to manage the login
  
  public function login($username, $password) {   // here we manage the login of the user
    // sanitize
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    // query
    try {
      $query = "SELECT * FROM utenti WHERE username = :username";
      $rq = $this->PDO->prepare($query);
      $rq->bindParam(":username", $username, PDO::PARAM_STR);
      $rq->execute();
      $record = $rq->fetch(PDO::FETCH_ASSOC);
      if (strlen($username) > 20) {
        echo "<script>alert('Username troppo lunga!');</script>";
        return false;
      } elseif ($rq->rowCount() == 0 ) {
        echo "<script>alert('Username errata!');</script>";
        return false;
      }  elseif
      // check of the password

       (password_verify($password, $record['password'])) {
        
          try {     //before login clean table utentiloggati
            $query = "DELETE FROM utentiloggati";  //sanitize not necessary
            $rq = $this->PDO->prepare($query);
            $rq->execute();
            } catch(PDOException $e) {
                echo "Errore di inserimento nel DB" . $e->getMessage();
            }
            // the password is OK we can activate the session and register the user in utentiloggati
          $sessionid = session_id();
          $_SESSION ["colore"] = "verde";
          $userid = $record['ID'];
          $query = "INSERT INTO utentiloggati (sessionid, idlogged) VALUES (:sessionid, :userid)";
          $rq = $this->PDO->prepare($query);
          $rq->bindParam("sessionid", $sessionid, PDO::PARAM_STR);
          $rq->bindParam("userid", $userid, PDO::PARAM_INT);
          $rq->execute();
          $id = $record['ID'];
          header('location: controlpanel.php');
          exit;        
      } else {           // if we are here the password is not correct
        echo "<script>alert('Password errata!');</script>";
      }
    
      } catch(PDOException $e) {
          echo "Errore dati non validi" . $e->getMessage();
      }
  }
  
  // methods to manage the logout
  
  public function logout() {   // we must cancel the user from the table utentiloggatitodo
    try {
      $query = "DELETE FROM utentiloggati";
      $rq = $this->PDO->prepare($query);
      //$session_id = session_id();
      //$rq->bindParam(":sessionid", $session_id, PDO::PARAM_STR);
      $rq->execute();
    } catch(PDOException $e) {
      echo "Errore di logout" . $e->getMessage();
  }
  session_destroy();
  header('location: login.php');
  }
  
}

?>