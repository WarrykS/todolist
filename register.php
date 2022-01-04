<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
// Recupere les données de session.php
require('session.php');
// demande à l'utilisateur de rentrer les login
if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){

    // assigner a $username la valeur que l'on rentre puis enlève les antislash avant les apostrophes
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn, $username);
    // assigner a $email la valeur que l'on rentre puis enlève les antislash avant les apostrophes
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn, $email);
    // assigner a $password la valeur que l'on rentre puis enlève les antislash avant les apostrophes
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
  // envoie les valeurs rentrées sur la bdd dans la table users + cryptage mdp avec .hash
    $query = "INSERT into `users` (username, email, password)
              VALUES ('$username', '$email', '".hash('sha256', $password)."')";
  // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    // si l'inscription a bien fonctionnée, ecrire message de succès
    if($res){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
       </div>";
    }
}else{
?>
        // formulaire d'inscription avec methode post
<form class="box" action="" method="post">
    <h1 class="box-logo box-title"><a href="register.php"></a></h1>
    <h1 class="box-title">Inscription</h1>
    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
    <input type="text" class="box-input" name="email" placeholder="Email" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
</form>
<?php } ?>
</body>
</html>