<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jonathan Stowell
 * Date: 03/06/12
 * Time: 21:59
 * To change this template use File | Settings | File Templates.
 */
class UsersController extends AppController {
    var $name = 'Users';
    var $components = array('Auth');

    function beforeFilter(){
        $this->Auth->userModel = 'User';
        $this->Auth->allow('*');
    }

    function register(){
        if(!empty($this->data)){
            // Here you should validate the username (min length, max length, to not include special chars, not existing already, etc)
            // As well as the password
            if($this->User->validates()){
                $this->User->save($this->data);
                // Let's read the data we just inserted
                $data = $this->User->read();
                // Use it to authenticate the user
                $this->Auth->login($data);
                // Then redirect
                $this->redirect('/');
            }
        }
    }

    function login(){
        if(!empty($this->data)){
            // If the username/password match
            if($this->Auth->login($this->data)){
                $this->redirect('/');
            } else {
                $this->User->invalidate('username', 'Username and password combination is incorrect!');
            }
        }
    }

    function logout(){
        $this->Auth->logout();
        $this->redirect('/');
    }
}
?>
