<?php

namespace application\models;

use application\core\Model;

class Main extends Model{

    public function checkLogin($email){
        return $this->db->column("SELECT id FROM users WHERE email = '$email'");
    }
   
    public function getUsers(){
       $users = $this->db->row('SELECT users.*, t_koatuu_tree.ter_address  FROM `users` INNER JOIN `t_koatuu_tree` ON  users.terr_id = t_koatuu_tree.ter_id');
       return $users;
    }

    public function createUser($name, $email, $terr_id){
        $this->db->query("INSERT INTO `users` (`name`, `email`, `terr_id`) VALUES ('$name', '$email', '$terr_id')");
    }

    public function getRegions($pid){
       if($pid==="null")
            return $regs = $this->db->row("SELECT *  FROM `t_koatuu_tree` WHERE `ter_pid` IS NULL");
        return $regs = $this->db->row("SELECT *  FROM `t_koatuu_tree` WHERE `ter_pid` = '$pid'"); 
    }

    public function getUser($id){
        $user = $this->db->row("SELECT users.*, t_koatuu_tree.ter_address  FROM `users` INNER JOIN `t_koatuu_tree` ON  users.terr_id = t_koatuu_tree.ter_id WHERE users.id='$id'");
       return $user;
    }
}
