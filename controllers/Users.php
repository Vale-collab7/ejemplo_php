<?php

require_once "models/User.php";
class Users{

    public function main(){}

    public function userRolCreate(){
        $rol = new User;
        $rol->setRolCode(2);
        $rol->setRolName("employed");
        $rol->createRol();
    }

    public function userRolRead(){
        $roles = new User;
        $roles = $roles->readRoles();
        print_r($roles);
    }
    
    public function userRolUpdate(){
        $rolId = new User;
        $rolId = $rolId->getRolById(3);
        
        
        $rolUp = new User;
        $rolUp->setRolCode($rolId->getRolCode());
        $rolUp->setRolName("seller");
        $rolUp->updateRol();
    }

    public function userRolDelete(){
        $rolDel = new User;
        $rolDel->deleteRol(4);
    }
    public function userCreate (){
        $user = new User;
        $user->setRolCode(1);
        $user->setUserCode(10);
        $user->setUserName("Julito");
        $user->setUserLastName("perez");
        $user->setUserId("123456789");
        $user->setUserEmail("julper@gmail.com");
        $user->setUserPass("jojojojo");
        $user->setUserState(2);
        $user->createUser();

        print_r($user);
    }

    public function userRead (){
        $users = new user;
        $users = $users->readUsers();
        print_r($users);
    }
    public function userReadByCode (){
        $user = new User;
        $user = $user->getUserByCode(10);
        print_r($user);
    }

    public function userUpdate (){
        $user = new User;
        $user = $user->getUserByCode(10);
        
        $userUp = new User;
        $userUp->setRolCode(1);        
        $userUp->setUserCode($user->getUserCode());
        $userUp->setUserName("hola");
        $userUp->setUserLastName("lolo");
        $userUp->setUserId("123456789");
        $userUp->setUserEmail("jula@gmail.com");
        $userUp->setUserPass("jojojojo");
        $userUp->setUserState(2);
        $userUp->updateUser();
        print_r($userUp);
    }

    public function userDelete (){
        $user = new User;
        $user->deleteUser(10);
    }

}

?>