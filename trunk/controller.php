<?php

class AppController
{
    public $uses = array('Course');
    public $config = null;
    /*
     *   Load the models
     */
    public function __construct()
    {
        $this->config = Config::getInstance();
        
        if (isset($this->uses)){
            foreach ($this->uses as $use){
                $model = '../models/'.strtolower($use).'.php';
                
                if (!file_exists($model)) {
                    throw new Exception('Missing model: '.$model,1);
                }
                
                require_once($model);
                $this->$use = new $use();
            }
        }
        
        if (!$this->config->isAjax){
        }
    }


    public function index()
    {
        set('page_title','First Finna page');
    }
    
}

?>
