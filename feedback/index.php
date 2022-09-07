<?php
#connexion a la base de donnees
$connexion = new PDO('mysql:host=localhost;dbname=feedback', 'root', 'root');
# requette pour compter le nombre de pouce rouge
$pouceRougeRequest = $connexion->prepare("SELECT COUNT(*) as nbr_pouce_rouge FROM reponses WHERE entre = 'Pouce Rouge'");
$pouceRougeRequest->execute();
$nbrPouceRouge = $pouceRougeRequest->fetch();
$nbrPouceRouge = $nbrPouceRouge['nbr_pouce_rouge'];

# requette pour compter le nombre de pouce vert
$pouceVertRequest = $connexion->prepare("SELECT COUNT(*) as nbr_pouce_vert FROM reponses WHERE entre = 'Pouce Vert'");
$pouceVertRequest->execute();
$nbrPouceVert = $pouceVertRequest->fetch();
$nbrPouceVert = $nbrPouceVert['nbr_pouce_vert'];

if(isset($_POST['pouce-rouge'])){
  #requette pour enregister une reponse avec comme valeur Pouce Rouge
  $request = $connexion->prepare("INSERT INTO reponses (entre) VALUES (?)");
  $request->execute(array('Pouce Rouge'));
}

if(isset($_POST['pouce-vert'])){
  #requette pour enregister une reponse avec comme valeur Pouce Rouge
  $request = $connexion->prepare("INSERT INTO reponses (entre) VALUES (?)");
  $request->execute(array('Pouce Vert'));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
  <title>Document</title>
  <style>
    #btn{
      display: flex;
      justify-content: space-around;
    }

    form{
      margin-top: 200px;
    }

    button{
      width: 200px;
      height: 40px;
    }

    #pr{
      background-color: red;
    }

    #pv{
      background-color: green;
    }
  </style>
</head>
<body>
  <div class="container">
    <form method="post">
      <div id="btn">
        <div>
          <button id="pr" name="pouce-rouge" value="Pouce Rouge">
            <i class="fas fa-thumbs-down"></i> Pouce Rouge
          </button>
        </div>

        <div>
          <button id="pv" name="pouce-vert" value="Pouce Vert">
            <i class="fas fa-thumbs-up"></i> Pouce Vert
          </button>
        </div>
      </div>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th>Nombre de Pouces Rouges</th>
          <th>Nombre de Pouces Verts</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $nbrPouceRouge; ?></td>
          <td><?php echo $nbrPouceVert; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>