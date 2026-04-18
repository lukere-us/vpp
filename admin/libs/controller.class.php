<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 * Whenever a controller is created, we also
 * 1. initialize a session
 * 2. check if the user is not logged in anymore (session timeout) but has a cookie
 * 3. create a database connection (that will be passed to all models that need a database connection)
 * 4. create a view object
 */
class controller extends common {

    function __construct($module) {

        //intilize module (backoffice or reservation)
        $this->module = $module;

        session::init();


        // create a view object (that does nothing, but provides the view render() method)

        $this->view = new view($this->module);
        $this->read = new read();
    }

    /**
     * loads the model with the given name.
     * @param $name string name of the model
     */
    public function loadModel($name,$module=null) {

        $this->module=($module?$module:$this->module);
        $path = $this->module . "/" . MODELS_PATH . "model_" . strtolower($name) . '.class.php';
        if (file_exists($path)) {
            require $this->module . "/" . MODELS_PATH . "model_" . strtolower($name) . '.class.php';
            // The "Model" has a capital letter as this is the second part of the model class name,
            // all models have names like "LoginModel"
            $modelName = $name . 'Model';
            return new $modelName();
        }
        return false;
    }

}
