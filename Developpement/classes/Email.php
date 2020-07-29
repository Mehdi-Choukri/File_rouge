<?php
class Email
{
    private $_db ,$_data;

    public function __construct($document = null)
    {
        $this->_db = DB::getInstance();

    }
    public function find($email = null )
    {
         if($email)
         {
             $field='EMAIL';
             $data = $this->_db->get('verified_email',array($field, "=" ,$email));
             if($data->count())
             {
                 $this->_data = $data->first();
                 return true;
             }
         }
         return false;

    }
    public function create($fields)
    {
        if(!$this->_db->insert('verified_email', $fields))
        {
            throw new Exception('Un problème est survenu lors de l\'ajout du signataire .');

        }
    }

}


?>