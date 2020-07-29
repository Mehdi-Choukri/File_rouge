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
    $roleUser = $user->data()->ROLE;
    
    
  
     
   
   

}


include 'design/header_co.php';

?>

 
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Consultation des documents</title>
</head>
<body>
<div class="consultation-form">
         <div class="consultation-form-table">
    
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
                    <th scope="col">Action</th>
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
                            else if( !empty($doc->SIGNED_BY1) && empty($doc->SIGNED_BY2))
                            {
                                $trColor = 'style="background-color:#b6bfb4"';

                            }
                            else if(!empty($doc->SIGNED_BY2) && !empty($doc->SIGNED_BY1))
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
                            if( empty($doc->SIGNED_BY1)  || empty($doc->SIGNED_BY2)   )
                            {
                                echo '<td ><a  href="signature.php?Num='.$doc->N_DOCUMENT.'">Signer</a></td>';

                            }
                            else 
                            {
                                echo '<td><a  href="doctopdf.php?Num='.$doc->N_DOCUMENT.'">Imprimer</a></td>';
                            }
                        
                
                        
                        }
                    
                    
                    ?>
                    
                </tbody>
            </table>
         </div>
         <a href="index.php">Retour à la page de début</a>
</div>

    
</body>
</html>