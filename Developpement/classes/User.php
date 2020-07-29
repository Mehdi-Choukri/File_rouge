<?php

class User{
    private $_db ,$_data,$_sessionName, $_cookieName,$_isLoggedIn;


    public function __construct($user = null)
    {
        $this->_db = DB::getInstance();

        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName =Config::get('remember/cookie_name');
        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);
               if($this->find($user))
               {
                   $this->_isLoggedIn = true;
               }
               else
               {
                   //logout
               }
            }

        }
        else 
        {
            $this->find($user);
        }




    }
    public function create($fields)
    {
        if(!$this->_db->insert('users', $fields))
        {
            throw new Exception('There was a problem creating a user');

        }
    }
    public function find($email = null )
    {
         if($email)
         {
             $field='EMAIL';
             $data = $this->_db->get('users',array($field, "=" ,$email));
             if($data->count())
             {
                 $this->_data = $data->first();
                 return true;
             }
         }
         return false;

    }
    public function login($email = null , $password = null , $remember =false)
    { 
        
            if(!$email && !$password && $this->exists())
            {
                Session::put($this->_sessionName, $this->data()->EMAIL);
            }
            else
            {
                $email = $this->find($email);

            
         
          if($email)
         {
            
            if($this->data()->PASSWORD === Hash::make($password, $this->data()->SALT))
            {
               Session::put($this->_sessionName, $this->data()->EMAIL);

               if($remember){

                   $hash = Hash::unique();
                   
                   $hashCheck =$this->_db->get('users_session', array('USER_EMAIL','=', $this->data()->EMAIL));

                   if(!$hashCheck->count()){
                       $this->_db->insert('users_session',array(
                           'USER_EMAIL' => $this->data()->EMAIL,
                           'HASH' => $hash
                       ));

                   }else
                   {
                       $hash = $hashCheck->first()->HASH ;

                   }
                     
                   Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));

               }
            }
               
           
        }
        return true; 
        
    }

        return false;
    }
    public function update($fields = array(), $email = null)
    {
        if(!$email && $this->isLoggedIn()){
            $email = $this->data()->EMAIL;

        }

        if(!$this->_db->update('users', $email , $fields)){
            throw new Exception('There is a problem updating ');

        }


    }
    public  function data()
    {
        return $this->_data;
    }
    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }
    public function logout()
    {
        $this->_db->delete('users_session', array('USER_EMAIL','=', $this->data()->EMAIL));
        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }
    public function exists()
    {
        return (!empty($this->_data)) ? true : false;
    }
}


?>