<?php 
require_once 'core/model/CoreModel.php';

class UserModel extends CoreModel {
    public $_table = 'users';

    function __construct() {
        parent::__construct();
    }
}