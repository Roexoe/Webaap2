<?php
session_start();
include_once("header.php");
include_once('connection.php');
/**
 * @var PDO $pdo
 */
if(isset($_POST['submit'])) {
    $voornaam = $_POST['Voornaam'];
    $achternaam = $_POST['Achternaam'];
    $email = $_POST['Email'];
    $bericht = $_POST['Bericht'];

    $sql = "INSERT INTO Contact (Voornaam, Achternaam, Email, Bericht) VALUES (:voornaam, :achternaam, :email, :bericht)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':voornaam', $voornaam);
    $stmt->bindParam(':achternaam', $achternaam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':bericht', $bericht);
    $stmt->execute();

    header("Location: index.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="margin"></div>
    <div class="container">
  <img src="img/overonsoceaan.jpg" alt="Overons" class="background-image">
  <div class="text-over-image">
    <div class="tekstblokblok">
    <div class="contact-titel">Contact</div>
    <div class="contact-blok">
    <form class="form" action="contact.php" method="post">
    <div class="flex">
        <label for="Voornaam">Voornaam:</label>
        <div class="inputForm">
        <input class="input" type="text" name="Voornaam" id="Voornaam" required><br>
        </div>
        
        <label  for="Achternaam">Achternaam:</label>
        <div class="inputForm">
        <input class="input" type="text" name="Achternaam" id="Achternaam" required></input><br>
        </div>

        <label for="Email">Email:</label>
        <div class="inputForm">
        <input class="input" type="email" name="Email" id="Email" required><br>
        </div>

        <label for="Bericht">Bericht:</label>
        <div class="inputForm">
        <input class="input" type="text" name="Bericht" id="Bericht" required><br>
        </div>



    <button class="fancy" href="#">
        <span class="top-key"></span>
        <span class="text"><input class="fancy" type="submit" name="submit" value="Opslaan" class="button"></span>
        <span class="bottom-key-1"></span>
        <span class="bottom-key-2"></span>
    </button>
</form>
    </div>
  </div>
</div>
    </div>
    <?php
 
    include_once("footer.php");
 
    ?>
</body>
</html>