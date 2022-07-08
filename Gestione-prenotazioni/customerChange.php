<?php
require 'include/default.php';

if ($_POST != "") {
  if (isset($_POST['logout'])) {
    require 'include/logout.php';
  }
  if (isset($_POST['control'])) {
    header('location: controlpanel.php');
  } 
}

?>

<html lang="it-it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="max.dev@europe.com">
    <link rel="stylesheet" type="text/css" href="style-prenotazioni.css">
    
    <title>Gestione prenotazioni - Cancella cliente</title>
    
  </head>
  <body>
    <header>
      <div class="center-text">
        <h1 class="title-h1">GESTIONE PRENOTAZIONI</h1>
        <h2 class="title-h2 light-yellow">CLIENTE DA MODIFICARE</h2>
      </div>
      
      <div class="buttons">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="get" class="logout"> 
          <input type="submit" class="btn-header" value="Elenco Clienti" name="customers">
        </form>
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" value="Pannello di Controllo" name="control" class="btn-header">
        </form>        
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" value="Disconnessione" name="logout" class="btn-header">
        </form>
      </div>
    </header>
    <div class='space'></div>
    
    <section>
      <table class="customer-table">
      
        <?php
        if (isset($_GET['modify'])) {
          $idModify = $_GET['modify'];
          require 'include/coonProcedurale.php';
          $sql = "SELECT * FROM clienti WHERE ID = ?";
          
          $record = mysqli_prepare($conn,$sql);
          mysqli_stmt_bind_param($record,'s',$idModify);
          mysqli_stmt_execute($record);
          $result = mysqli_stmt_get_result($record);
          
          while ($row = mysqli_fetch_assoc($result)) {
            $customerName = $row['nome'];
            $customerEmail = $row['email'];
            $customerNote = $row['note'];
            echo "<tr><th>ID</th><td>" . $row['ID'] . "</td></tr>";
            echo "<tr><th>NOME</th><td>" . $customerName . "</td></tr>";
            echo "<tr><th>EMAIL</th><td>" . $customerEmail . "</td></tr>";
            echo "<tr><th>NOTE</th><td>" . $customerNote . "</td></tr>";
          }
          } else {
          header('location: customerList.php');
        }
        ?> 
        
      </table>
    </section>
    
    <section class="section-new-customer">
      
      <div class="box-form-cancel">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="form-style">
          <label class="label-customer">nuova email:</label>
          <input type="email" name="email" value="<?php echo $customerEmail; ?>" required><br>
          <label class="label-customer">nuove note:</label>
          <input type="text" name="note" value="<?php echo $customerNote; ?>" required><br>
          <br>
          <input type="submit" class="light-btn" value="CONFERMA" name="change">
        </form>
      </div>
    </section>
    
    <?php
    if ($_POST != "") {
      if (isset($_POST['email'])) {

        require 'include/coonProcedurale.php';
        
        $cleanEmail = trim($_POST['email']);
        $cleanNote = trim($_POST['note']);
        $cleanName = htmlspecialchars($cleanName);
        $cleanEmail = filter_var(filter_var($cleanEmail, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        $cleanNote = htmlspecialchars($cleanNote);
        
        
        if (!(mb_strlen($cleanNote) >= 1 && mb_strlen($cleanNote) <= 255)) {
            echo "<script>alert('Le note possono essere al massimo 255 caratteri.');</script>";
            return false;
          } else {
            // now we can launch the query
              $sql = "UPDATE clienti SET nome=?, email=?, note=? WHERE ID = ?";
              if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "ssss", $customerName, $cleanEmail, $cleanNote, $idModify);
                mysqli_stmt_execute($stmt);
                echo "<script>alert('Registrazione effettuata con successo.');</script>";
            }
            echo "<script>window.location = 'customerList.php';</script>";
          }  
      }
    }
    ?>
    
    
  </body>
</html>