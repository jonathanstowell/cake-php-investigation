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
    var $components = array('Auth', 'Acl');

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

                // Set the user roles
                $aro = new Aro();
                $parent = $aro->findByAlias($this->User->find('count') > 1 ? 'User' : 'Super');

                $aro->create();
                $aro->save(array(
                    'model'        => 'User',
                    'foreign_key'    => $this->User->id,
                    'parent_id'    => $parent['Aro']['id'],
                    'alias'        => 'User::'.$this->User->id
                ));

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

    function install(){
        if($this->Acl->Aro->findByAlias("Admin")){
            $this->redirect('/');
        }
        $aro = new aro();

        $aro->create();
        $aro->save(array(
            'model' => 'User',
            'foreign_key' => null,
            'parent_id' => null,
            'alias' => 'Super'
        ));

        $aro->create();
        $aro->save(array(
            'model' => 'User',
            'foreign_key' => null,
            'parent_id' => null,
            'alias' => 'Admin'
        ));

        $aro->create();
        $aro->save(array(
            'model' => 'User',
            'foreign_key' => null,
            'parent_id' => null,
            'alias' => 'User'
        ));

        $aro->create();
        $aro->save(array(
            'model' => 'User',
            'foreign_key' => null,
            'parent_id' => null,
            'alias' => 'Suspended'
        ));

        $aco = new Aco();
        $aco->create();
        $aco->save(array(
            'model' => 'User',
            'foreign_key' => null,
            'parent_id' => null,
            'alias' => 'User'
        ));

        $aco->create();
        $aco->save(array(
            'model' => 'Post',
            'foreign_key' => null,
            'parent_id' => null,
            'alias' => 'Post'
        ));

        $this->Acl->allow('Super', 'Post', '*');
        $this->Acl->allow('Super', 'User', '*');
        $this->Acl->allow('Admin', 'Post', '*');
        $this->Acl->allow('User', 'Post', array('create'));
    }
}
?>
