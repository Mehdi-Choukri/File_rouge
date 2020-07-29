<?php
require_once 'core/init.php';
$user = new User();

if(!$user->isLoggedIn())
{
    Redirect::to('index.php');

}
else
{
   
    $document_Number = DB::getInstance()->get('documents',array('N_DOCUMENT', ">=" ,'0'));
    $allDocs= $document_Number->results();

   
  
     
   
   

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">N° Document</th>
      <th scope="col">N° Compte</th>
      <th scope="col">Date</th>
      <th scope="col">CIN</th>
      <th scope="col">Nom bénéficiaire</th>
      <th scope="col">RIB bénéficiaire</th>
      <th scope="col">Type d'opération</th>
      <th scope="col">Montant</th>
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($allDocs as $doc)
        {
            if($doc->SIGNED == 0)
            {
                $trColor = 'style="background-color:#edb9c2"';
            }
            else if($doc->SIGNED == 1)
            {
                $trColor = 'style="background-color:#b6bfb4"';

            }
            else
            {
                $trColor = 'style="background-color:#d4f5cb"';
            }

            echo '<tr '.$trColor.'> <th scope="row">'.$doc->N_DOCUMENT.'</th>';
            echo '<td>'.$doc->NUM_COMPTE.'</td>';
            echo '<td>'.$doc->DATE.'</td>';
            echo '<td>'.$doc->CIN_BEN.'</td>';
            echo '<td>'.$doc->NOM_BEN_PC.'</td>';
            echo '<td>'.$doc->RIB_BEN.'</td>';
            echo '<td>'.$doc->OP_TYPE.'</td>';
            echo '<td>'.$doc->DOC_MONTANT.'</td>';
            if($doc->SIGNED == 2)
            {
                echo '<td><a  href="doctopdf.php?Num='.$doc->N_DOCUMENT.'" style="color:black;text-decoration:underline;">Imprimer</a></td>';

            }
            else
            {
                echo '<td></td>';
            }
          
            
            
           
        }
      
      
      ?>
    
  </tbody>
</table>

<a href="index.php">Retour à la page de début</a>
    
</body>
</html>