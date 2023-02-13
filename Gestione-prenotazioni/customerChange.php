<?php
require 'include/default.php';

if ($_POST != "") {
  if (isset($_POST['logout'])) {
    require 'include/logout.php';
  }
  if (isset($_POST['control'])) {
    header('location: controlpanel');
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
          $sql = "SELECT * FROM customers WHERE ID = ?";
          
          $record = mysqli_prepare($conn,$sql);
          mysqli_stmt_bind_param($record,'s',$idModify);
          mysqli_stmt_execute($record);
          $result = mysqli_stmt_get_result($record);
          
          while ($row = mysqli_fetch_assoc($result)) {
            $customerName = $row['customer_name'];
            $customerEmail = $row['customer_email'];
            $customerNote = $row['customer_text'];
            echo "<tr><th>ID</th><td id='myId'>" . $row['ID'] . "</td></tr>";
            echo "<tr><th>NOME</th><td>" . $customerName . "</td></tr>";
            echo "<tr><th>EMAIL</th><td>" . $customerEmail . "</td></tr>";
            echo "<tr><th>NOTE</th><td>" . $customerNote . "</td></tr>";
          }
          } else {
          header('location: customerlist');
        }
        ?> 
        
      </table>
      
    </section>
    
    <!-- For printing result from server -->
    <p class="result" style="
      text-align: center;
      color: red;
      padding: 10px;
      margin: 10px;
      font-style: bold;
      font-size: 25px;">
    </p>
    
    <section class="section-new-customer">
      
      <div class="box-form-cancel">
        <div class="form-style">
          <label class="label-customer">nuova email:</label>
          <input type="email" name="email" value="<?php echo $customerEmail; ?>" id="email" required><br>
          <label class="label-customer">nuove note:</label>
          <input type="text" name="note" value="<?php echo $customerNote; ?>" required id="note"><br>
          <br>
          <input onclick="sendJSON()" type="submit" class="light-btn" value="CONFERMA" name="change">
        </div>
      </div>
    </section>
      
    <script>
      function sendJSON(){
                
        let result = document.querySelector('.result');
        let myId = document.querySelector('#myId');
        let email = document.querySelector('#email');
        let note = document.querySelector('#note');
        
        // Creating a XHR object
        let xhr = new XMLHttpRequest();
        let url = "./my-api/customerChange-api.php";
   
        // open a connection
        xhr.open("POST", url, true);

        // Set the request header i.e. which type of content you are sending
        xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");

        // Create a state change callback
        xhr.onreadystatechange = function () {

          // Print received data from server
          result.innerHTML = this.responseText;
        };

        // Converting JSON data to string
        var data = JSON.stringify({ "myId": myId.textContent, "email": email.value, "note": note.value });
        
        // Sending data with the request
        xhr.send(data);
        
      }
    </script>
    
    
  </body>
</html>