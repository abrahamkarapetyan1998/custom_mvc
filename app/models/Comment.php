<?php
require_once 'app/helpers/Database.php';
require_once 'app/helpers/DbHelper.php';

class Comment extends DbHelper {
    public $name;
    public $email;
    public $title;
    public $description;
    public $table_name = 'comments';
    public $fields = ['name', 'email', 'title', 'description'];

    public function __construct() {
        $this->helper = parent::__construct();
    }

}