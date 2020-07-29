<?php
    require_once 'core/init.php';

   
 
    if(Input::exists())
    {
        //verification de l'email s'il existe dans la base de donnée 
        $emailToverify = new Email();
        if($emailToverify->find(Input::get('email')))
        {
            if(Token::check(Input::get('token')))
            {
 
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'user' => array(
                    'required' => true,
                    'min'=> 5,
                    'max'=> 20,
                ),
                'email' => array(
                    'required' => true,
                    'min'=> 9,
                    'max'=> 50,
                    'unique' => 'users'
                ),
                'password'=> array(
                    'required' => true,
                    'min'=> 6

                ),
                'password_again'=> array(
                    'required' => true,
                    'matches' => 'password'
                    
                ),
                'option' => array(
            
                    
                        'required' => true
                    
                    
                ),
            ));
            
            
            if($validate->passed())
            {
                $user = new User() ;
                $salt =Hash::salt(32);
         
                try{
                    $user->create(array(
                        'USER' => Input::get('user'),
                        'EMAIL' => Input::get('email'),
                        'PASSWORD' => Hash::make(Input::get('password'), $salt),
                        'ROLE' => Input::get('option'),
                        'SALT' =>$salt 
                        
                    ));
                    Session::flash('home','<div style="color:green" role="alert">Félicitation vous étes inscrit vous pouvez désormais vous connecter</div>');
                    Redirect::to('index.php');

                } catch(Exception $e)
                {
                    die($e->getMessage());

                }
                // Session::flash('success','You registered successfully');
                // header('Location: index.php ');

            }
            else
            {
                foreach($validate->errors() as $error)
                {
                    echo $error ."<br>";

                }
            }
        }

        }else{
            
            echo '<div class="alert alert-danger" style="margin-top:220px;position:absolute;margin-left:250px" role="alert">Vous n\'avez pas encore la permission d\'inscription veillez  à contacter le maitre de l\'application .</div>';
           // echo '<div style="color:red;margin-top:220px;position:absolute;margin-left:250px">Vous n\'avez pas encore la permission d\'inscription veillez  à contacter le maitre de l\'application .</div>';

        }


        
    }

 include 'design/header.php';
 
?>
 
   
 <link rel="stylesheet" href="style/style.css">

    <title>S'inscrire</title>
</head>
<body>
<!-- <form action="" method="post">
<div class="field">
    <label for="user">Nom d'utilisateur</label>
    <input type="text" name="user" id="user" value="" autocomplete="off">
 

    </div>
    <div class="field">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="" autocomplete="off">

    </div>
    <div class="field">
    <label for="password">Choose a Password</label>
    <input type="password" name="password" id="password" value="" autocomplete="off">

    </div>
    <div class="field">
    <label for="password_again">Enter your Password</label>
    <input type="password" name="password_again" id="password_again" value="" autocomplete="off">

    </div>
    <div class="field">
       <label for="option2">Premier signataire</label> <input type="radio" name="option" id="option2" value="2">
       <label for="option3">deuxiéme signataire</label> <input type="radio" name="option" id="option3" value="3">

    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate()?>">
    <input type="submit" value="Register">

    //
     

</form> -->
<div class="container login-container">
         <div class="login-container-form">
             <form action="" method="POST">
                     <div class="form-group row">
                        <label for="user" class="col-sm-2 col-form-label">Nom d'utilisateur</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="user" id="user" value="" autocomplete="off">
                        </div>
                     </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="email" value="" autocomplete="off" placeholder="Email">
                        </div>
                     </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="password" value="" autocomplete="off" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_again" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" name="password_again" id="password_again" value="" autocomplete="off" placeholder="Password">
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Signataire</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  name="option" id="option2" value="2" checked>
                                    <label class="form-check-label" for="option2">
                                    Premier signataire
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  name="option" id="option3" value="3" value="option2">
                                    <label class="form-check-label" for="gridRadios2">
                                   Deuxiéme signataire
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                        </div>
                    </div>


                </form>
                <div class="blank">

                </div>
            
         </div>
        
    
</body>
</html>