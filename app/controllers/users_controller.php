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
    var $components = array('Auth', 'Acl', 'Email');

    function beforeFilter(){
        $this->Auth->userModel = 'User';
        $this->Auth->allow('*');
    }

    function register(){
        if(!empty($this->data)){
            if(isset($this->data['User']['password2']))
                $this->data['User']['password2hashed'] = $this->Auth->password($this->data['User']['password2']);
            if($this->User->save($this->data)){
                $data = $this->User->read();
                $this->Auth->login($data);

                $aro = new Aro();
                $parent = $aro->findByAlias($this->User->find('count') > 1 ? 'User' : 'Super');

                $aro->create();
                $aro->save(array(
                    'model'        => 'User',
                    'foreign_key'    => $this->User->id,
                    'parent_id'    => $parent['Aro']['id'],
                    'alias'        => 'User::'.$this->User->id
                ));

                $this->redirect('/');
            } else {
                $this->Session->setFlash('There was an error signing up. Please, try again.', 'flash_error');
            }
        }
    }

    function login(){
        if(!empty($this->data)){
            if($this->Auth->login($this->data)){
                $this->redirect('/');
            } else {
                $this->User->invalidate('username', 'Username and password combination is incorrect!', 'flash_error');
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
