<?php

/**
 * Set PHP Defaults
 */
error_reporting(E_ALL | E_STRICT);

/**
 * Paths
 */
define('IMG_URL','/img/');
define('ELEMENTS_PATH','../views/elements/');
define('ROOT_URL','/finna/');

/**
 * Config singleton
 */
class Config
{
    private static $instance = null;
    public $template = "default";
    
    /**
     *  Database Configurations
     */
    public $dev = array(
            'host'      => 'naturesalternativesinc.com',
            'login'     => 'naturesa_finna',
            'password'  => 'cs147!'
    );
    
    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    function __construct()
    {
        $domain = (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '';
        switch ($domain) {
            default:
                define('DEBUG',false);
                define('ENVIRONMENT', 'development');
                $this->db = $this->dev;
                break;
        }
      
        
        ini_set('display_errors', DEBUG);
        
        $this->isAjax = (!empty($_SERVER['CONTENT_TYPE']) && strtolower(substr($_SERVER['CONTENT_TYPE'],0,33)) == 'application/x-www-form-urlencoded') || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }
}

?>
