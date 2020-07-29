<?php

require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn())
{
    Redirect::to('index.php');

}
if(Input::exists())
{
    $email = new Email();
    $userToVerify = new User();
    
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'email' => array(
                'required'=> true ,
                'min' => 9,
                'max' => 50
            )
        ));
        if($validate->passed())
        {
            if(!$userToVerify->find(Input::get('email')))
            {
                if(!$email->find(Input::get('email')))
                {
                    try
                    {
                        $email->create(array(
                            'EMAIL' => Input::get('email'),
                            'ADDED_BY' => $user->data()->EMAIL
                        ));
                        $message = '<div class="alert alert-success"  style="margin-top:-75px;position:absolute;margin-left:250px" role="alert">L\'email du signatiare a été ajouter avec succés .</div>';

                        Session::flash('home',$message);
                        Redirect::to('index.php');
                    }catch(Exception $e){
                        die($e->getMessage());
        
                    }
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert"  style="margin-top:175px!important;position:absolute!important;margin-left:250px!important;">Le signataire existe déja dans la liste des signataires  </div>';
                }

            }
            else
            {
                echo '<div class="alert alert-danger" style="margin-top:175px!important;position:absolute!important;margin-left:250px!important;" role="alert">Le signataire a déja un compte dans l\'application</div>';

            }
       
        
        
           
        }
    else{
        foreach($validate->errors() as $error)
        {
        echo $error ,'<br>';
        
        }
    }
}

include 'design/header_co.php';
?>
   <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Ajout signataire</title>
</head>
<body>
<div class="container login-container">
         <div class="login-container-form">
            <form action="" method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="email">L'email du signataire</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" autocomplete="off" value="">
                </div>
                <div class="col-sm-10">
                     
                     <button type="submit" class="btn btn-primary button-color">Ajouter le signataire</button>
                </div>
                
            

            </div>
            

            </form>
         </div>
</div>

    
</body>
</html>
