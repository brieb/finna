<?php

function dispatch($url) 
{
    $config  = Config::getInstance();
    $page = '';
    
    try {
        $appController = new AppController();
        
        if ($url == '') {
            call_user_func_array(array($appController,'index'), null);
            $action = 'index';
        } else {
            $urlArray = explode("/",$url);
            $action = strtolower(array_shift($urlArray));
        
            if (method_exists($appController, $action)) {
                call_user_func_array(array($appController, $action), $urlArray);
            } else {
                throw new Exception(DEBUG?'Method missing for: '.$action:'Sorry! This page does not exist. ' .$action);
            }
        }
        
        $view = '../views/'.$action.'.php';
        if (!file_exists($view) && !$config->isAjax) {
            throw new Exception(DEBUG?'View missing for: '.$action:'Sorry! This page does not exist.');
	}

	if (!empty($config->template)){
	    set('view', $view);
	    $page = '../views/templates/'.$config->template.'.php';
        } else {
	    $page = $view;
	}

    } catch (Exception $e) {
        $stack_trace = $e->getFile().' on line '.$e->getLine().'<br>';
        if ($config->isAjax){
            global $json;
            $json['msg'] = 'Initialization Error: '.$e->getMessage();
            $json['message'] = $e->getMessage();
            $json['code'] = $e->getCode();
            $json['stack_trace'] = $stack_trace;
            echo json_encode($json);
        } else {
	    echo '('.$e->getCode().') '.$e->getMessage();
            exit;
        }
    }
    
    return $page;
}

?>
