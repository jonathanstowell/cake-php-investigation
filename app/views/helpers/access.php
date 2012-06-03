<?
class AccessHelper extends Helper{
    var $helpers = array("Session");

    function isLoggedin(){
        App::import('Component', 'Auth');
        $auth = new AuthComponent();
        $auth->Session = $this->Session;
        $user = $auth->user();
        return !empty($user);
    }
}
?>