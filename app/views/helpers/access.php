<?php
class AccessHelper extends Helper{
    var $helpers = array("Session");
    var $Access;
    var $Auth;
    var $user;

    function beforeRender(){
        App::import('Component', 'Access');
        $this->Access = new AccessComponent();

        App::import('Component', 'Auth');
        $this->Auth = new AuthComponent();
        $this->Auth->Session = $this->Session;

        $this->user = $this->Auth->user();
    }

    function check($aco, $action='*'){
        if(empty($this->user)) return false;
        return $this->Access->checkHelper('User::'.$this->user['User']['id'], $aco, $action);
    }

    function isLoggedin(){
        return !empty($this->user);
    }

    function getmy($what){
        return !empty($this->user) && isset($this->user['User'][$what]) ? $this->user['User'][$what] : false;
    }
}
?>