 
   <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <title>Profile</title>
</head>
<body>
    
 
<?php 
require_once 'core/init.php';
 
if(Session::exists('home'))
{
    echo '<p>'. Session::flash('home').'</P>';
     echo Session::flash('success');

}
// echo Session::get(Config::get('session/session_name'));

  $user = new User();
 if($user->isLoggedIn())
 {
     $page_connexion = true;
    include 'design/header_co.php';
     ?>
     <div class="container">

    
        <div class="classIndex" >
            <p>Bienvenue <a href="#"><?php echo escape($user->data()->USER);?></a></p>
            <ul>
                <li><a href="logout.php" class="badge badge-success">Deconnexion</a></li>
                <li><a href="update.php" class="badge badge-success">Modifier votre nom d'utilisateur</a></li>
                <li><a href="changepassword.php" class="badge badge-success">Modifier votre mot de passe</a></li>
                <?php
                if($user->data()->ROLE == 1)
                {
                    echo '<li><a href="ajoutSignataire.php" class="badge badge-success">Ajouter un nouveau Signataire</a></li>';
                    echo '<li><a href="doc_insert.php" class="badge badge-success">Ajouter un nouveau document</a></li>';
                    echo '<li><a href="consultation.php" class="badge badge-success">Consulter les documents </a></li>';
                    
                }
                else
                {
                    echo '<li><a href="consultation_action.php" class="badge badge-success">Consulter les documents </a></li>';
                }
        
                ?>
                

                
            </ul>

        </div>
     </div>
    
     <?php

 }
 else
 {
    include 'design/header.php';
    echo '<div class="alert alert-danger" style="margin-top:175px!important;position:absolute!important;margin-left:250px!important;" role="alert">Vous devrier  <a href="login.php">Se connecter </a> ou <a href="register.php">S\'inscire</a>  </p></div>';
 
 }



?>
</body>
</html>
