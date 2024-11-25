<?php
class Role {
    public $role_id;
    public $role_name;
    public $role_description;
    public $role_status;
    public $role_created_at;
    public $role_updated_at;

    function __construct($role_id, $role_name, $role_description, $role_status, $role_created_at = null, $role_updated_at = null) {
        $this->role_id = $role_id;
        $this->role_name = $role_name;
        $this->role_description = $role_description;
        $this->role_status = $role_status;
        $this->role_created_at = $role_created_at ?: date('Y-m-d H:i:s');
        $this->role_updated_at = $role_updated_at ?: date('Y-m-d H:i:s');
    }
}



?>