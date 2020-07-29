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
    $count_Doc= $document_Number->count();
    $year = date('Y');
     
    $Numero_doc_format =  ($count_Doc+1) . '/' . substr($year,2,4);
   
   

}
if(Input::exists())
{
    $document = new Document();
    $checkDocument;
    
    
        try{
            if(Input::get('CIN_BEN_PC') != '')
            {
                $checkDocument = 'MISE';
 
                //rib=null
                $document->create(array(
                    'N_DOCUMENT' => Input::get('N_document'),
                    'NUM_COMPTE' => Input::get('RIB'),
                    'DATE' => Input::get('DATE'),
                    'OBJECT' => 'NULL',
                     
                    'CIN_BEN' => Input::get('CIN_BEN_PC'),
                    'NOM_BEN_PC' => Input::get('NOM_BEN_PC'),
                    'RIB_BEN' => 'NULL',
                    'OP_TYPE' => Input::get('OP_TYPE'),
                    'DOC_MONTANT' => Input::get('DOC_MONTANT'),
                    'DOC_MONTANT_LETTRE' => Input::get('LETTRE_MONTANT'),
                    'TYPE_DOC' => $checkDocument,
                    'SIGNED' => 0,

                ));
                //PDF creation qui va etre lorsque un signataire signe un document dans la base de donnée ajouter lien des signatures comme attribut dans documents
                
                $message = '<div class="alert alert-success"  style="margin-top:-75px;position:absolute;margin-left:250px" role="alert">Mise inserée avec succés.</div>';


                  Session::flash('home',$message);

                        Redirect::to('index.php');
                       

            }
            else{
                $checkDocument='ORDRE';
                $document->create(array(
                    'N_DOCUMENT' => Input::get('N_document'),
                    'NUM_COMPTE' => Input::get('RIB'),
                    'DATE' => Input::get('DATE'),
                    'OBJECT' => 'NULL',
                     
                    'CIN_BEN' => 'NULL',
                    'NOM_BEN_PC' => Input::get('NOM_BEN_PC'),
                    'RIB_BEN' => Input::get('RIB_BEN'),
                    'OP_TYPE' => Input::get('OP_TYPE'),
                    'DOC_MONTANT' => Input::get('DOC_MONTANT'),
                    'DOC_MONTANT_LETTRE' => Input::get('LETTRE_MONTANT'),
                    'TYPE_DOC' => $checkDocument,
                    'SIGNED' => 0,

                ));
                $message = '<div class="alert alert-success"  style="margin-top:-75px;position:absolute;margin-left:250px" role="alert">Ordre inseré avec succés.</div>';

                Session::flash('home',$message);

                Redirect::to('index.php');
                
                
            }



        }catch(Exception $e){
        
            die($e->getMessage());

        }

    }
    
 

    include 'design/header_co.php';
?>

    <link rel="stylesheet" href="style/style.css">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

 
    <title>Ajouter un document</title>
</head>
<body>
    <div class="container login-container">
        <div class="login-container-form">
            <form action="" method="post" >
 
                <div class="form-group row">
                        <label for="N_document" class="col-sm-2 col-form-label">N°Document</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control"name="N_document" id="N_document" value="<?php echo $Numero_doc_format ?>" autocomplete="off">
                        </div>
                </div>
               
                <div class="form-group row">
                        <label for="banque" class="col-sm-2 col-form-label">Banque</label>
                        <div class="col-sm-10">
                        <select class="form-control" name="banque"   id="banque" onchange="getSelectedValue()" autocomplete="off">
                        <?php
                            $document_Agency =  DB::getInstance()->get('bank_accounts',array('CODE_CITY', "=" ,'46000'));
                            foreach($document_Agency->results() as $doc)
                            {
                                echo " <option value='". $doc-> AGENCY ."'>".$doc-> AGENCY."</option>";
                            }
                            

                            
                            ?>
                        
                        </select>
                        </div>
                </div>
                
                <div class="form-group row">
                        <label for="RIB" class="col-sm-2 col-form-label">RIB</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control"size="25"   name="RIB" id="RIB" value="" autocomplete="off">
                        </div>
                </div>
                
                <div class="form-group row">
                        <label for="NOM_BEN_PC" class="col-sm-2 col-form-label">Bénéficiaire </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control"  name="NOM_BEN_PC" id="NOM_BEN_PC" value="" autocomplete="off">
                        </div>
                         
                        <label for="CIN_BEN_PC" class="col-sm-2 col-form-label">CIN du Bénéficiaire</label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="CIN_BEN_PC" id="CIN_BEN_PC" value="" autocomplete="off">
                        </div>
                </div>
                
                <div class="form-group row">
                        <label for="RIB_BEN" class="col-sm-2 col-form-label">RIB Bénéficiaire</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" size="45"  name="RIB_BEN" id="RIB_BEN" value="" autocomplete="off">
                        </div>
                </div>
                
                <div class="form-group row">
                        <label for="OP_TYPE" class="col-sm-2 col-form-label">Type d'opération</label>
                        <div class="col-sm-10">
                        <select  class="form-control" name="OP_TYPE" id="OP_TYPE" autocomplete="off">
                            <option value="Mise à disposition">Mise à disposition</option>
                            <option value="Ordre de Prélèvement">Ordre de virement</option>
                            <option value="Pension Alimentaire">Pension Alimentaire</option>
                        </select>
                        </div>
                </div>
                 
                <div class="form-group row">
                        <label for="DOC_MONTANT" class="col-sm-2 col-form-label">Montant en DHS</label>
                        <div class="col-sm-2">
                        <input type="text" class="form-control"  name="DOC_MONTANT" id="DOC_MONTANT" value="" autocomplete="off">
                        </div>
                         
                        <label for="LETTRE_MONTANT" class="col-sm-2 col-form-label">Montant en lettre</label>
                        <div class="col-sm-5">
                        <input type="text" class="form-control" name="LETTRE_MONTANT" id="LETTRE_MONTANT" autocomplete="off">
                        </div>
                </div>
                 
                <div class="form-group row">
                        <label for="DATE" class="col-sm-2 col-form-label">Date d'opération</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control"  name="DATE" id="DATE" autocomplete="off">
                        </div>
                </div>
                
                <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label"><span id="validationErrors"></span></label>
                        
                </div>
                <div class="col-sm-10">
                     
                     <button type="submit" id="doc_insert_submition" class="btn btn-primary button-color">Ajouter le document</button>
                </div>
                



            </form>
        </div>
 
        
    </div>
    <div class="blank">

    </div>

</body>
<script src="Script/main.js"></script>
</html>

