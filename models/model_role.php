<?php
require_once 'nodes/node_role.php';

class modelRole{
    private $roles = [];
    private $nextId = 1;

    public function __construct(){
        if(isset($_SESSION['roles'])){
            $this->roles = unserialize($_SESSION['roles']);
            $this->nextId = count($this->roles) + 1;
        }else{
            $this->initiliazeDefaultRoles();
        }
    }

    public function initiliazeDefaultRoles(){
        $this->addRole(role_name: "admin", role_description: "Administrator", role_status: 1);
        $this->addRole(role_name: "user", role_description: "Customer", role_status: 1);
        $this->addRole(role_name: "kasir", role_description: "Pembayaran", role_status: 0);
    }

    public function addRole($role_name, $role_description, $role_status){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = $created_at;
        $peran = new \Role($this->nextId++, $role_name, $role_description, $role_status);
        var_dump($peran);
        $this->roles[] = $peran;
        $this->saveToSession();
    }

    private function saveToSession(){
        $_SESSION['roles'] = serialize($this->roles);
    }

    public function getAllRoles(){
        return $this->roles;
    }

    public function getRoleById($role_id){
        foreach($this->roles as $role){
            if($role->role_id == $role_id){
                return $role;
            }
        }
        return null;
    }

    public function updateRole($role_id, $role_name, $role_description, $role_status){
        foreach($this->roles as $role){
            if($role->role_id == $role_id){
                $role->role_name=$role_name;
                $role->role_description=$role_description;
                $role->role_status=$role_status;
                $role->role_update_at=date('Y-m-d H:i:s');
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }

    public function deleteRole($role_id){
        foreach($this->roles as $key => $role){
            if($role->role_id == $role_id){
                unset($this->roles[$key]);
                $this->roles = array_values($this->roles);
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }

    public function getRoleByName($role_name){
        foreach($this->roles as $role){
            if($role->role_name() == $role_name){
                return $role;
            }
        }
    }
}

?>