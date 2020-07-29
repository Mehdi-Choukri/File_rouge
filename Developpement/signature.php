<?php 
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn())
{
    Redirect::to('index.php');

}
else
{
    if(isset($_POST['signaturesubmit'])){ 
        //update de la table document 
      $roleUser = $user->data()->ROLE;
      $SignedByUser = $user->data()->EMAIL;
       
    
        $signature = $_POST['signature'];
        $signatureFileName = uniqid().'.png';
        $signature = str_replace('data:image/png;base64,', '', $signature);
        $signature = str_replace(' ', '+', $signature);
        $data = base64_decode($signature);
        $file = 'signatures/'.$signatureFileName;
        file_put_contents($file, $data);
        if(Input::exists())
        {
            $document = new Document();
            $Ndocument = Input::get('Num');
            $document_Number = DB::getInstance()->get('documents',array('N_DOCUMENT', "=" ,$Ndocument));
            $allDocs= $document_Number->results()[0];
            $cpt_SIGNED = $allDocs->SIGNED;
            //roleuser = 2 pour le premier signataire et 3 pour le dernier 
            if($roleUser == 2)
            {
                $linktoUpdate = 'LINK_SIGNE1';
                $SignedByField = 'SIGNED_BY1';
            }
            else if($roleUser == 3)
            {
                $linktoUpdate = 'LINK_SIGNE2';
                $SignedByField = 'SIGNED_BY2';
            }
             $newcptSigned = $cpt_SIGNED +1;
            
     
            
            try
            {
                $document_Number = DB::getInstance()->updateDocument('documents', $Ndocument , array(
                    'SIGNED' => $newcptSigned ,
                   $linktoUpdate => $signatureFileName,
                   $SignedByField => $SignedByUser

     
                ));
                Session::flash('home','Le document a été signé avec succés');
                Redirect::to('index.php');
            }catch(Exception $e){
                die($e->getMessage());
    
            }
    
        }
        $msg = "<div class='alert alert-success'>Signature Enregister</div>";
    } 

}

?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        #canvasDiv{
            position: relative;
            border: 2px dashed grey;
            height:300px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br>
                <?php echo isset($msg)?$msg:''; ?>
                <h2>Veuillez dessiner votre signature dans le canvas</h2>
                <hr>
                <div id="canvasDiv"></div>
                <br>
                <button type="button" class="btn btn-danger" id="reset-btn">Effacer</button>
                <button type="button" class="btn btn-success" id="btn-save">Sauvegarder</button>
            </div>
            <form id="signatureform" action="" style="display:none" method="post">
                <input type="hidden" id="signature" name="signature">
                <input type="hidden" name="signaturesubmit" value="1">
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script src="Script/signature.js">
    
</script>
</html>