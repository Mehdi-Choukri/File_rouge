<?php

class Document{
    private $_db ,$_data;

    public function __construct($document = null)
    {
        $this->_db = DB::getInstance();

    }
    public function create($fields)
    {
        if(!$this->_db->insert('documents', $fields))
        {
           
            throw new Exception('Problem de creation du document');

        }
    }
    public function find($Code_POSTAL = null )
    {
         if($Code_POSTAL)
         {
             $field='CODE_CITY';
             $data = $this->_db->get('bank_accounts',array($field, "=" ,$Code_POSTAL));
             if($data->count())
             {
                 $this->_data = $data->results();
                 return true;
             }
         }
         return false;

    }
    public function findDocument($N_document = null )
    {
         if($N_document)
         {
             $field='N_DOCUMENT';
             $data = $this->_db->get('documents',array($field, "=" ,$N_document));
             if($data->count())
             {
                 $this->_data = $data->results()[0];
                 return true;
             }
         }
         return false;

    }
    public  function data()
    {
        return $this->_data;
    }
    public function update($fields = array(), $Ndoc= null)
{
     

    if(!$this->_db->update('documents', $Ndoc , $fields)){
        throw new Exception('Une erreur est survenue lors de lupdate');

    }


}
    
}


?>