<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn())
{
    Redirect::to('index.php');

}
else
{
$mpdf = new \Mpdf\Mpdf();
$document = new Document();
    if($document->findDocument(Input::get('Num')))
    {
   

        $data = $document->data();

        $TYPE_DOC = $data->TYPE_DOC;
        if($TYPE_DOC === 'MISE')
        {
                    $date =  $data->DATE;
                $Ndoc = $data->N_DOCUMENT;
                $OPERATION = $data->OP_TYPE;
                $NUM_CMPT = $data->NUM_COMPTE;
                $NOM_BEN = $data->NOM_BEN_PC;
                $CIN_BEN = $data->CIN_BEN;
                $SOMME = $data->DOC_MONTANT ;
                $SOMME_LETTRE = $data->DOC_MONTANT_LETTRE ;
                $LINK_IMG1 = $data->LINK_SIGNE1 ;
                $LINK_IMG2 = $data->LINK_SIGNE2 ;

                $user->find($data->SIGNED_BY1);
                $SignedUser1 = $user->data()->USER ;
                
                

                $user->find($data->SIGNED_BY2);
                $SignedUser2 = $user->data()->USER ;
                

                $pdfData ='';
                $pdfData .='<img src="../Images/logo-ocp-doc.jpg" width="80" height="110" style="margin-left:50px;" alt="">';
                $pdfData .='<p style="margin-left:250px;font-weight:bold;font-size:21px">Safi, le '.  $date  .'</p>';
                $pdfData .='<p style="margin-left:110px;font-weight:bold;font-size:21px">FIT/S N°' .$Ndoc.'</p>';
                $document_Agency =  DB::getInstance()->get('bank_accounts',array('NUM_ACCOUNT', "=" ,$NUM_CMPT));
            
                $banque = $document_Agency->results()[0]->AGENCY;


                $pdfData .='<p style="margin-left:250px;font-weight:bold;font-size:21px;text-decoration:underline;">'.$banque.'</p>';

                if($document_Agency->results()[0]->CODE_CITY === '46000')
                {
                    $CITY = 'SAFI' ;

                }

                $pdfData .='<p style="margin-left:350px;font-weight:bold;font-size:21px;text-decoration:underline;">'.$CITY.'</p>';
                $pdfData .='<p style="margin-left:110px;font-weight:bold;font-size:21px;text-decoration:underline;">Objet:<span style="font-size:21px!important;font-weight:normal;font-size:21px;text-decoration: none!important;" >'.$OPERATION.'.</span></p>';
                $pdfData .='<p style="margin-left:110px;font-weight:bold;font-size:21px">IMMEDIAT (SAFI)</p>';
                $pdfData .='<p style="margin-left:110px;margin-top:40px;font-size:18px">Par prélèvement sur notre compte n°<span style="font-weight:bold">'.$NUM_CMPT.'</span>, nous<br>
                vous prions de mettre à la disposition de <span style="font-weight:bold">'.$NOM_BEN.' CIN N° '.$CIN_BEN.'.</span>
            
            </p>';
                $pdfData .='<p style="margin-left:110px;margin-top:20px;font-size:18px">La somme de <span style="font-weight:bold">'.$SOMME.',00 DH</span><span style="font-weight:bold;font-size:17px;margin-left:10px">('.$SOMME_LETTRE.').</span></p>';
                $pdfData .='<div style="display:flex;"><div style="margin-left:110px;"><div><p style="font-weight:bold;font-size:18px;">P. Le Directeur Exécutif Finance<br> Et Contrôle de Gestion & p.o</p><img src="signatures/'.$LINK_IMG1.'" width="200" height="100"  alt="">

            <p style="margin-left:40px;text-transform: uppercase;color:#1F2DAF;font-weight:bolder;font-family:Arial, Helvetica, sans-serif">'. $SignedUser1.'</p></div>
                </div> 
                <div style="margin-left:470px;margin-top:-238px"><div><p style="font-weight:bold;font-size:18px;">P. Le Président Directeur <br>Général & po</p><img src="signatures/'.$LINK_IMG2.'" width="200" height="100"  alt="">

            <p style="margin-left:40px;text-transform: uppercase;color:#1F2DAF;font-weight:bolder;font-family:Arial, Helvetica, sans-serif">'. $SignedUser2.'</p></div>
                </div> 

            </div>

                <p style="margin-left:110px;margin-top:10px;font-size:10px">
                OCP S.A.<br>
                Société anonyme au capital de 8.287.500.000 DH – Registre du commerce de Casablanca n° 40327 – Identifiant Fiscal n° 02220794 – Patente n° 36000670<br>
                2-4, rue Al Abtal, Hay Erraha, 20 200 Casablanca, Maroc – Téléphone/standard : + 212 (0) 5 22 23 20 25 / + 212 (0) 5 22 92 30 00 / + 212 (0) 5 22 92 40 00
                
                </p>   ';
                //write PDF ;
                $mpdf->writeHTML($pdfData);
                //output to download 
                $mpdf->Output($NOM_BEN."_".$OPERATION.".pdf",'D');
            }
            else
            {
                $date =  $data->DATE;
                $Ndoc = $data->N_DOCUMENT;
                $OPERATION = $data->OP_TYPE;
                $NUM_CMPT = $data->NUM_COMPTE;
                $NOM_BEN = $data->NOM_BEN_PC;
                $CIN_BEN = $data->CIN_BEN;
                $RIB_BEN =$data->RIB_BEN;
                $SOMME = $data->DOC_MONTANT ;
                $SOMME_LETTRE = $data->DOC_MONTANT_LETTRE ;
                $LINK_IMG1 = $data->LINK_SIGNE1 ;
                $LINK_IMG2 = $data->LINK_SIGNE2 ;

                $user->find($data->SIGNED_BY1);
                $SignedUser1 = $user->data()->USER ;
                
                

                $user->find($data->SIGNED_BY2);
                $SignedUser2 = $user->data()->USER ;
                

                $pdfData ='';
                $pdfData .='<img src="../Images/logo-ocp-doc.jpg" width="80" height="110" style="margin-left:50px;" alt="">';
                $pdfData .='<p style="margin-left:250px;font-weight:bold;font-size:13px">Safi, le '.  $date  .'</p>';
                $pdfData .='<p style="margin-left:110px;font-weight:bold;font-size:13px">FIT/S N°' .$Ndoc.'</p>';
                $document_Agency =  DB::getInstance()->get('bank_accounts',array('NUM_ACCOUNT', "=" ,$NUM_CMPT));
            
                $banque = $document_Agency->results()[0]->AGENCY;


                $pdfData .='<p style="margin-left:250px;font-weight:bold;font-size:13px;text-decoration:underline;">'.$banque.'</p>';

                if($document_Agency->results()[0]->CODE_CITY === '46000')
                {
                    $CITY = 'SAFI' ;

                }

                $pdfData .='<p style="margin-left:350px;font-weight:bold;font-size:13px;text-decoration:underline;">'.$CITY.'</p>';
                $pdfData .='<div style="display:flex;">
                <div style="margin-left:110px;font-size:13px!important;border:3px solid black;font-weight:normal;font-size:13px;width:300px;text-decoration: none!important;" ><p style="padding-right:10px ;padding-left:10px ;">Virement au compte <br> N°  '.$RIB_BEN.'</p></div>
               
                </div>
                <div style="margin-left:450px;margin-top:-65px;font-size:13px!important;border:3px solid black;font-weight:normal;font-size:13px;width:150px;text-decoration: none!important;" ><p style="padding-right:10px ;padding-left:10px ;text-align:center;">  '.$SOMME.' MAD  </p></div>
                <div style="margin-left:450px">
                <p>'. $SOMME_LETTRE.' dirhams.</p>
                
                </div>
                <div style="margin-left:110px;font-size:13px">
                    <p>Messieurs.</p>
                      
                        <p style="margin-left:40px">Par le débit de notre compte n° '.$NUM_CMPT.', nous vous<br>
                        prions d\'effectuer le virement mentionné sous rubrique.</p>
                    
                   
                       <p style="margin-left:40px"> Veuillez agréer, Messieurs, nos salutation distinguées.</p>
                
                </div>
                <div style="margin-left:220px;font-size:13px;border:3px solid black;width:350px;">
                    <p style="font-weight:bold;font-size:13px;padding-right:30px;padding-left:30px;">Bénéficiaire : '.$NOM_BEN.'</p>
                
                </div>
                
                 
                                
                 <div style="display:flex;"><div style="margin-left:110px;"><div><p style="font-weight:bold;font-size:13px;">P. Le Directeur Exécutif Finance<br> Et Contrôle de Gestion & p.o</p><img src="signatures/'.$LINK_IMG1.'" width="200" height="100"  alt="">
                
                <p style="margin-left:40px;text-transform: uppercase;color:#1F2DAF;font-weight:bolder;font-family:Arial, Helvetica, sans-serif">'. $SignedUser1.'</p></div>
                    </div> 
                    <div style="margin-left:470px;margin-top:-210px"><div><p style="font-weight:bold;font-size:13px;">P. Le Président Directeur <br>Général & po</p><img src="signatures/'.$LINK_IMG2.'" width="200" height="100"  alt="">
                
                <p style="margin-left:40px;text-transform: uppercase;color:#1F2DAF;font-weight:bolder;font-family:Arial, Helvetica, sans-serif">'. $SignedUser2.'</p></div>
                    </div> 
                
                </div>
                
                    <p style="margin-left:110px;margin-top:10px;font-size:10px">
                    OCP S.A.<br>
                    Société anonyme au capital de 8.287.500.000 DH – Registre du commerce de Casablanca n° 40327 – Identifiant Fiscal n° 02220794 – Patente n° 36000670<br>
                    2-4, rue Al Abtal, Hay Erraha, 20 200 Casablanca, Maroc – Téléphone/standard : + 212 (0) 5 22 23 20 25 / + 212 (0) 5 22 92 30 00 / + 212 (0) 5 22 92 40 00
                    
                    </p>   
                    ';
                //write PDF ;
                $mpdf->writeHTML($pdfData);
                //output to download 
                $mpdf->Output($NOM_BEN."_".$OPERATION.".pdf",'D');
            }
        }
    }

   


    


?>