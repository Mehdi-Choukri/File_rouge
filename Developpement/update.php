<?php

require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn())
{
    Redirect::to('index.php');

}
if(Input::exists())
{
    if(Token::check(Input::get('token')))
    {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required'=> true ,
                'min' => 5,
                'max' => 20
            )
        ));
        if($validate->passed())
        {
            try
            {
                $user->update(array(
                    'user' => Input::get('username')
                ));
                $message = '<div class="alert alert-success"  style="margin-top:-75px;position:absolute;margin-left:250px" role="alert">Votre Nom a été modifier avec succées .</div>';
                Session::flash('home',$message);
                Redirect::to('index.php');
            }catch(Exception $e){
                die($e->getMessage());

            }

        }else{
            foreach($validate->errors() as $error)
            {
                echo $error ,'<br>';

            }
        }
    }
}
include 'design/header_co.php';

?>
  <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <title>Mise à jour</title>
</head>
<body>
    <!-- <form action="" method="post">
        <div class="field">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" autocomplete="off" value="<?php echo escape($user->data()->USER)?>">
            <input type="submit" value="Update">
            <input type="hidden" name="token" value="<?php echo Token::generate();?>">

        </div>

</form> -->



<div class="container login-container">
         <div class="login-container-form">
             <form action="" method="post">
                     <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Nom d'utilisateur</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" id="username" value="<?php echo escape($user->data()->USER)?>" autocomplete="off">
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                            <button type="submit" class="btn btn-primary button-color">Modifier</button>
                        </div>
                    </div>
             </form>
         </div>
</div>
</body>
</html>
