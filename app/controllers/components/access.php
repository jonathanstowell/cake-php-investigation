<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jonathan Stowell
 * Date: 04/06/12
 * Time: 11:47
 * To change this template use File | Settings | File Templates.
 */
class AccessComponent extends Object{
    var $components = array('Acl', 'Auth');
    var $user;
    var $cached;

    function startup(){
        $this->user = $this->Auth->user();
    }

    function check($aco, $action='*'){
        if(empty($this->user)){
            return false;
        }

        if(isset($this->cached['User::'. $this->user['User']['id'] . '/aco:' . $aco . '/action:' . $action])){
            return $this->cached['User::'.$this->user['User']['id'] . '/aco:' . $aco . '/action:' . $action];
        }

        $cache = Cache::read(Inflector::slug('acl/' . 'User::'. $this->user['User']['id'] . '/aco:' . $aco . '/action:' . $action), 'one day');
        if(empty($cache)){
            $cache = $this->Acl->check('User::'. $this->user['User']['id'], $aco, $action) ? 'true' : 'false';
            Cache::write(Inflector::slug('acl/' . 'User::'. $this->user['User']['id'] . '/aco:' . $aco . '/action:' . $action), $cache, 'one day');
            $this->cached['User::'. $this->user['User']['id'] . '/aco:' . $aco . '/action:' . $action] = $cache;
        }

        return $cache=='true' ? true : false;
    }

    function checkHelper($aro, $aco, $action = "*"){
        if(isset($this->cached[$aro . '/aco:' . $aco . '/action:' . $action]))
            return $this->cached[$aro . '/aco:' . $aco . '/action:' . $action] == 'true' ? true : false;

        $cache = Cache::read(Inflector::slug('acl/' . $aro . '/aco:' . $aco . '/action:' . $action), 'one day');
        if(empty($cache)){
            $acl = new AclComponent();
            App::import('Component', 'Acl');
            $cache = $acl->check($aro, $aco, $action) ? 'true' : 'false';
            Cache::write(Inflector::slug('acl/' . $aro . '/aco:' . $aco . '/action:' . $action), $cache, 'one day');
            $this->cached[$aro . '/aco:' . $aco . '/action:' . $action] = $cache;
        }

        return $cache=='true' ? true : false;
    }

    function getmy($what){
        return !empty($this->user) && isset($this->user['User'][$what]) ? $this->user['User'][$what] : false;
    }
}
?>