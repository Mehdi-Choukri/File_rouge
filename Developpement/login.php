 <?php
 require_once 'core/init.php';
 if(Input::exists()){
     if(Token::check(Input::get('token')))
     {
         $validate = new Validate();
         $validation = $validate->check($_POST,array(
             'email'=> array('required' => true),
             'password'=>array('required' => true),
         ));
         if($validate->passed())
         {
             $user = new User();
             $remember = (Input::get('remember') === 'on') ? true : false;
             $login = $user->login(Input::get('email'),Input::get('password'), $remember);
             if($login)
             {
                Redirect::to('index.php');
             }
             else
             {
                 echo '<p>Login failed</p>';
             }

         }
         else
         {
             foreach($validate->errors() as $error)
             {
                 echo $error ,'<br>';
             }

         }
     }
 }
 include 'design/header.php';
 
 ?>
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


  
 </head>
 <body>
   
     <div class="container login-container">
         <div class="login-container-form">
            <form action="" method="POST">
                    <!-- <div class="form-group row">
                        <div class="field">
                            <label class="col-sm-2 col-form-label" for="email">Email</label>
                            <input type="text" name="email" id="email" autocomplete="off">


                        </div>
                        <div class="field">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" autocomplete="off">
                            

                        </div>
                        <div class="field">
                            
                            <input type="checkbox" name="remember" id="remember" autocomplete="off">
                            <label for="remember">Remember me</label>

                        </div>
                        <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                        <input type="submit" value="Log in">


                    </div> -->
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off">
                        </div>
                    </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Remember me</div>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"  type="checkbox" name="remember" id="remember" autocomplete="off">
                            <label class="form-check-label" for="remember">
                            Souviens de moi
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Connexion</button>
                    </div>
                </div>

            
                </form>
                <a class="redirectLink" href="register.php">Vous n'êtes pas encore inscrit ?</a>

         </div>
         <div class="login-container-img">
             <img src="images/1login.png" alt="" srcset="">
              
         </div>
       
           
        
     </div>
    
     
 </body>

 </html>