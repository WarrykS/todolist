<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Tâches</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

    <?php
    /* Recupere les données de session.php */
    require('session.php');

   // connexion à la bdd
    $dbh = new PDO('mysql:host=localhost;dbname=tache', 'root', 'toor');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // requète, prendre toutes les valeurs de tache dans la bdd
    $taches = $dbh->query('SELECT * FROM tache');

    ?>
</head>




<script>
/* Création du bouton fermer et l'inclure a chaque élement de la liste */
var myNodelist = document.getElementsByTagName("LI");
var i;
for (i = 0; i < myNodelist.length; i++) {
  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  myNodelist[i].appendChild(span);
}

/* Si le bouton fermer est selectionné, fermer l'element de la liste */
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}


/* Ajouter un nouvel element dans la liste quand on clique sur le bouton Ajouter */
function newElement() {

  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
  } else {
    document.getElementById("myUL").appendChild(li);
  }
  document.getElementById("myInput").value = "";

  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  li.appendChild(span);

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}
</script>
</head>


<body>

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="img/promeo.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
            Tâches de proméo
        </a>
        <a class="btn btn-primary" href="logout.php" role="button">Déconnexion</a>
    </div>
</nav>
  <!-- ajoue de la barre de saisie  ainsi que du bouton ajouter --!>
<div id="myDIV" class="header">
  <h2>Tâches</h2>
  <input type="text" id="myInput" placeholder="Saisir tâche...">
  <span onclick="newElement()" class="addBtn">Ajouter</span>
</div>

<ul id="myUL">

    <?php foreach ($taches as $tache): ?>
     <li>   <?= $tache['libelle']?> </li>
    <?php endforeach; ?>
</ul>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>