<?php

class CustomerMng {
  private $PDO;
  
  public function __construct($PDOconn) {
    $this->PDO = $PDOconn;
  }
  
  // method to create the list of customer
  
  public function customerList() {
    try {
      $query = "SELECT * FROM customers ORDER BY customer_name ASC";
      $rq = $this->PDO->prepare($query);
      $rq->execute();
      return $rq;
    } catch (PDOException $e) {
      echo "Errore di estrazione dati dal DB" . $e->getMessage();
      return false;
    }
    return true;
  }
  
  // method to delete a customer with all his reservations
  
  public function customerDelete($idCancel, $nameCancel) {
    try {
      $query = "DELETE FROM customers WHERE ID = :id";
      $rq = $this->PDO->prepare($query);
      $rq->bindParam(":id", $idCancel, PDO::PARAM_STR);
      $rq->execute();
    } catch(PDOException $e) {
        echo "Errore di cancellazione nel DB clienti" . $e->getMessage();
        return false;
    }
    try {
      $query1 = "DELETE FROM customer_reservation WHERE customer = :nameCancel";
      $rq = $this->PDO->prepare($query1);
      $rq->bindParam(":nameCancel", $nameCancel, PDO::PARAM_STR);
      $rq->execute();
    } catch(PDOException $e) {
        echo "Errore di cancellazione nel DB reservations" . $e->getMessage();
        return false;
    }
    return true;
    }
  
  // method to add a customer
  
  public function customerAdd($nome, $email, $note) {
    
    $cleanName = trim($nome);
    $cleanEmail = trim($email);
    $cleanNote = trim($note);
    $cleanName = htmlspecialchars($cleanName);
    $cleanEmail = filter_var(filter_var($cleanEmail, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    $cleanNote = htmlspecialchars($cleanNote);

    try{
    $query = "SELECT * FROM customers WHERE (customer_name = :cleanName)";
    $rq = $this->PDO->prepare($query);
    $rq->bindParam(":cleanName", $cleanName, PDO::PARAM_STR);
    $rq->execute();
    } catch(PDOExecption $e) {
      echo "Errore di estrazione" . $e->getMessage();
    }
    // check if the username is not already present into the DB
    if ($rq->rowCount() > 0) {
      echo "<script>alert('Un cliente con questo nome e già presente! Ricontrolla l\'elenco clienti oppure scegli un altro nome.');</script>";
      return false;
      // check if user name has been provided
      } elseif (mb_strlen($cleanName) == 0 ) {
        echo "<script>alert('Nome non inserito!');</script>";
        return false;
        // check of the length of username and note
      } elseif (!(mb_strlen($cleanName) >= 3 && mb_strlen($cleanName) <= 50)) {
        echo "<script>alert('Nome troppo lungo o troppo corto -min 3, max 50 caratteri-');</script>";
        return false;
      } elseif (!(mb_strlen($cleanEmail) <= 50)) {
        echo "<script>alert('Indirizzo email troppo lungo, max 50 caratteri');</script>";
        return false;
      } elseif (!(mb_strlen($cleanNote) >= 1 && mb_strlen($cleanNote) <= 255)) {
        echo "<script>alert('Le note possono essere al massimo 255 caratteri.');</script>";
        return false;
      } else {
        // now we can launch the query
        $query = "INSERT INTO customers (customer_name, customer_email, customer_text) VALUES (:cleanName, :cleanEmail, :cleanNote)";
        $rq = $this->PDO->prepare($query);
        $rq->bindParam(":cleanName", $cleanName, PDO::PARAM_STR);
        $rq->bindParam(":cleanEmail", $cleanEmail, PDO::PARAM_STR);
        $rq->bindParam(":cleanNote", $cleanNote, PDO::PARAM_STR);
        $rq->execute();
        }
      return true;
  }
  
  // method to change a customer
  
  public function changeCustomer($email, $note, $idModify) {
    
    $cleanEmail = trim($email);
    $cleanNote = trim($note);
    $cleanIdModify = trim($idModify);
    $cleanEmail = filter_var(filter_var($cleanEmail, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    $cleanNote = htmlspecialchars($cleanNote);
    $cleanIdModify = htmlspecialchars($cleanIdModify);

    // check 
   
    if (!(mb_strlen($cleanEmail) <= 50)) {
        echo "<script>alert('Indirizzo email troppo lungo, max 50 caratteri');</script>";
        return false;
      } elseif (!(mb_strlen($cleanNote) >= 1 && mb_strlen($cleanNote) <= 255)) {
        echo "<script>alert('Le note possono essere al massimo 255 caratteri.');</script>";
        return false;
      } else {
        // now we can launch the query
        $query = "UPDATE customers SET customer_email = :cleanEmail, customer_text = :cleanNote WHERE ID = :cleanIdModify";
        $rq = $this->PDO->prepare($query);
        $rq->bindParam(":cleanEmail", $cleanEmail, PDO::PARAM_STR);
        $rq->bindParam(":cleanNote", $cleanNote, PDO::PARAM_STR);
        $rq->bindParam(":cleanIdModify", $cleanIdModify, PDO::PARAM_STR);
        $rq->execute();
        }
      return true;
  }
  
}

?>