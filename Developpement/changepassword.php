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
            'current_password' => array(
                'required' => true,
                'min' => 6
                
            ),
            'password_new' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new_again' => array(
                'required' => true,
                'min' => 6 ,
                'matches' => 'password_new'
            ),
        ));
        if($validate->passed())
        {
             
            if(Hash::make(Input::get('current_password'), $user->data()->SALT) !== $user->data()->PASSWORD){
                echo 'Votre mot de passe est incorrect ';

            }else
            {
                $salt = Hash::salt(32) ;
                $user->update(array(
                    'PASSWORD' => Hash::make(Input::get('password_new'),$salt),
                    'SALT' =>$salt

                ));
                $message = '<div class="alert alert-success"  style="margin-top:-75px;position:absolute;margin-left:250px" role="alert">Votre Mot de passe a été modifier avec succées .</div>';

                Session::flash('home',$message);
                Redirect::to('index.php');
            }

        }
        else{
            foreach($validate->errors() as $error)
            {
                echo $error,'<br>';
            }
        }
    }
}
include 'design/header_co.php';


?>
 <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <title>Mise à jour mot de passe</title>
</head>
<body>
<div class="container login-container">
         <div class="login-container-form">

            <form action="" method="post">
                <div class="form-group row field">
                    <label class="col-sm-2 col-form-label" for="current_password">Votre mot de passe actuel</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" name="current_password" id="current_password" value="" autocomplete="off">
                    </div>
                    </div>
                <div class="form-group row field">
                    <label class="col-sm-2 col-form-label" for="password_new">Votre nouveau mot de passe</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" name="password_new" id="password_new" value="" autocomplete="off">
                    </div>
                    </div>
                    <div class="form-group row field">
                    <label class="col-sm-2 col-form-label" for="password_new_again">Retaper votre nouveau mot de passe</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" name="password_new_again" id="password_new_again" value="" autocomplete="off">
                    </div>

                    </div>
                    <input class="col-sm-2 col-form-label" type="hidden" name="token" value="<?php echo Token::generate()?>">
                    <div class="form-group row">
                        <div class="col-sm-10">
                     
                    <button type="submit" class="btn btn-primary button-color">Modifier le mot de passe</button>
                    </div>
                    </div>

            </form>
         </div>
</div>