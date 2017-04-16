<?php
require_once 'app/models/UserModel.php';

class UserController {

    private $_dwoo;

    function __construct($dwoo) {
        $this->_dwoo = $dwoo;
    }

    public function signInAction() {
        $data = array();
        if ($_POST) {
            $validationErrors = array();
            
            $data['user']['name'] = $userName = isset($_POST['name']) ? (string) trim($_POST['name']) : false;
            $data['user']['password'] = $userPassword = isset($_POST['password']) ? (string) trim($_POST['password']) : false;

            if (empty($userName)) {
                $validationErrors['errors']['name'] = 'Name is required';
            }
            if (empty($userPassword)) {
                $validationErrors['errors']['password'] = 'Password is required';
            }
            
            if (isset($validationErrors['errors'])) {
                $data['errors'] = $validationErrors['errors'];
            } else {
                $userModel = new UserModel();
                if ($userModel->selectWhere(array('name' => $userName, 'password' => md5($userPassword)), $userModel->_table)) {
                    $_SESSION['user']['name'] = $userName;
                    header('Location: index.php?controller=user&action=profile');
                } else {
                    $data['errors']['signInError'] = 'Wrong name or password';
                }
            }
        }
        $this->_dwoo->output('app/views/user/signin.tpl', $data);
    }

    public function signUpAction() {
        $data = array();
        if($_POST) {
            $validationErrors = array();
            $userModel = new UserModel();

            $data['user']['name'] = $userName = isset($_POST['name']) ? (string) trim($_POST['name']) : false;
            $data['user']['email'] = $userEmail = isset($_POST['email']) ? (string) trim($_POST['email']) : false;
            $userPassword = isset($_POST['password']) ? (string) trim($_POST['password']) : false;
            $userPasswordConfirm = isset($_POST['password_confirm']) ? (string) trim($_POST['password_confirm']) : false;

            if (empty($userName)) {
                $validationErrors['errors']['name'] = 'Name is required';
            }
            if (empty($userEmail)) {
                $validationErrors['errors']['email'] = 'Email is required';
            }
            if (empty($userPassword)) {
                $validationErrors['errors']['password'] = 'Password is required';
            }
            if (empty($userPasswordConfirm)) {
                $validationErrors['errors']['password_confirm'] = 'Confirm Password';
            }
            if (!isset($validationErrors['errors']['password']) && !isset($validationErrors['errors']['password_confirm'])) {
                if($userPassword != $userPasswordConfirm) {
                    $validationErrors['errors']['Password_match'] = 'Passwrods don\'t match';
                }
            }
            

            if (!isset($validationErrors['errors']['email'])) {
                if($userModel->selectFirst(array('email' => $userEmail), $userModel->_table)) {
                    $validationErrors['errors']['emailExist'] = 'Email exist';
                }
            }
            if (isset($validationErrors['errors'])) {
                $data['errors'] = $validationErrors['errors'];
            } else {
                $signUpResult = $userModel->save(array('name' => $userName, 'email' => $userEmail, 'password' => md5($userPassword)), $userModel->_table);
                if ($signUpResult) {
                    $_SESSION['user']['name'] = $userName;
                    header('Location: index.php?controller=user&action=profile');
                }
            }
        }
        $this->_dwoo->output('app/views/user/signup.tpl', $data);
    }

    public function profileAction() {
        $data = array();
        if ($_POST) {

        }
        $this->_dwoo->output('app/views/user/profile.tpl', $data);
    }
}
