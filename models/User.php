<?php

class User
{

    // Atributos
    private $dbh;
    private $rol_code;
    private $rol_name;
    private $user_code;
    private $user_name;
    private $user_lastname;
    private $user_id;
    private $user_email;
    private $user_pass;
    private $user_state;

    // Sobrecarga de Constructores
    public function __construct()
    {
        try {
            $this->dbh = DataBase::connection();
            $a = func_get_args();
            $i = func_num_args();
            if (method_exists($this, $f = '__construct' . $i)) {
                call_user_func_array(array($this, $f), $a);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # Construtor 00
    public function __construct0() {}

    # Constructor 02: Iniciar Sesión
    public function __construct2($user_email, $user_pass)
    {
        $this->user_email = $user_email;
        $this->user_pass = $user_pass;
    }

    # Constructor 09: Todos los atributos del objeto
    public function __construct9($rol_code, $rol_name, $user_code, $user_name, $user_lastname, $user_id, $user_email, $user_pass, $user_state)
    {
        $this->rol_code = $rol_code;
        $this->rol_name = $rol_name;
        $this->user_code = $user_code;
        $this->user_name = $user_name;
        $this->user_lastname = $user_lastname;
        $this->user_id = $user_id;
        $this->user_email = $user_email;
        $this->user_pass = $user_pass;
        $this->user_state = $user_state;
    }

    // Métodos setter y getter

    # Código del Rol
    public function setRolCode($rol_code)
    {
        $this->rol_code = $rol_code;
    }
    public function getRolCode()
    {
        return $this->rol_code;
    }

    # Nombre del Rol
    public function setRolName($rol_name)
    {
        $this->rol_name = $rol_name;
    }
    public function getRolName()
    {
        return $this->rol_name;
    }
    # Código del Usuario
    public function setUserCode($user_code)
    {
        $this->user_code = $user_code;
    }
    public function getUserCode()
    {
        return $this->user_code;
    }
    # Nombre del Usuario
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }
    public function getUserName()
    {
        return $this->user_name;
    }
    # Apellido del Usuario
    public function setUserLastName($user_lastname)
    {
        $this->user_lastname = $user_lastname;
    }
    public function getUserLastName()
    {
        return $this->user_lastname;
    }
    # Identificación del Usuario
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    # Email del Usuario
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }
    public function getUserEmail()
    {
        return $this->user_email;
    }
    # Contraseña del Usuario
    public function setUserPass($user_pass)
    {
        $this->user_pass = $user_pass;
    }
    public function getUserPass()
    {
        return $this->user_pass;
    }
    # Estado del Usuario
    public function setUserState($user_state)
    {
        $this->user_state = $user_state;
    }
    public function getUserState()
    {
        return $this->user_state;
    }


    // Métodos de persistencia a la base de datos

    # CU04 - Registrar Rol
    public function createRol()
    {
        try {
            $sql = 'INSERT INTO ROLES VALUES (:rolCode,:rolName)';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('rolCode', $this->getRolCode());
            $stmt->bindValue('rolName', $this->getRolName());
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # RF05_CU05 - Consultar Roles
    public function readRoles()
    {
        try {
            $rolList = [];
            $sql = 'SELECT * FROM ROLES';
            $stmt = $this->dbh->query($sql);
            foreach ($stmt->fetchAll() as $rol) {
                $rolObj = new User;
                $rolObj->setRolCode($rol['rol_code']);
                $rolObj->setRolName($rol['rol_name']);
                array_push($rolList, $rolObj);
            }
            return $rolList;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # RF06_CU06 - Obtener el Rol por el código
    public function getRolById($rolCode)
    {
        try {
            $sql = "SELECT * FROM ROLES WHERE rol_code=:rolCode";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('rolCode', $rolCode);
            $stmt->execute();
            $rolDb = $stmt->fetch();
            $rol = new User;
            $rol->setRolCode($rolDb['rol_code']);
            $rol->setRolName($rolDb['rol_name']);
            return $rol;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # RF07_CU07 - Actualizar Rol
    public function updateRol()
    {
        try {
            $sql = 'UPDATE ROLES SET
                            rol_code = :rolCode,
                            rol_name = :rolName
                        WHERE rol_code = :rolCode';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('rolCode', $this->getRolCode());
            $stmt->bindValue('rolName', $this->getRolName());
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # RF08_CU08 - Eliminar Rol
    public function deleteRol($rolCode)
    {
        try {
            $sql = 'DELETE FROM ROLES WHERE rol_code = :rolCode';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('rolCode', $rolCode);
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function createUser()
    {
        try {
            $sql = 'INSERT INTO usuarios VALUES (:rolCode, :userCode, :userName, :userLastname, :userId, :userEmail, :userPass, :userState)';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('rolCode', $this->getRolCode());
            $stmt->bindValue('userCode', $this->getUserCode());
            $stmt->bindValue('userName', $this->getUserName());
            $stmt->bindValue('userLastname', $this->getUserLastName());
            $stmt->bindValue('userId', $this->getUserId());
            $stmt->bindValue('userEmail', $this->getUserEmail());
            $stmt->bindValue('userPass', $this->getUserPass());
            $stmt->bindValue('userState', $this->getUserState());
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function readUsers()
    {
        try {
            $usersList = [];
            $sql = 'SELECT * FROM usuarios';
            $stmt = $this->dbh->query($sql);
            foreach ($stmt->fetchAll() as $user) {
                $userObj = new User;
                $userObj->setRolCode($user['rol_code']);
                $userObj->setUserCode($user['user_code']);
                $userObj->setUserName($user['user_name']);
                $userObj->setUserLastName($user['user_lastname']);
                $userObj->setUserId($user['user_id']);
                $userObj->setUserEmail($user['user_email']);
                $userObj->setUserPass($user['user_pass']);
                $userObj->setUserState($user['user_state']);
                array_push($usersList, $userObj);
            }
            return $usersList;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getUserByCode($user_code)
    {
        try {
            $sql = 'SELECT * FROM usuarios WHERE user_code = :user_code';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('user_code', $user_code);
            $stmt->execute();
            $userDb = $stmt->fetch();
            $user = new User;
            $user->setRolCode($userDb['rol_code']);
            $user->setUserCode($userDb['user_code']);
            $user->setUserName($userDb['user_name']);
            $user->setUserLastName($userDb['user_lastname']);
            $user->setUserId($userDb['user_id']);
            $user->setUserEmail($userDb['user_email']);
            $user->setUserPass($userDb['user_pass']);
            $user->setUserState($userDb['user_state']);
            return $user;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function updateUser()
    {
        try {
            $sql = 'UPDATE usuarios SET
                            rol_code = :rolCode,
                            user_code = :userCode,
                            user_name = :userName,
                            user_lastname = :userLastname,
                            user_id = :userId,
                            user_email = :userEmail,
                            user_pass = :userPass
                            WHERE user_code = :userCode';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('rolCode', $this->getRolCode());
            $stmt->bindValue('userCode', $this->getUserCode());
            $stmt->bindValue('userName', $this->getUserName());
            $stmt->bindValue('userLastname', $this->getUserLastName());
            $stmt->bindValue('userId', $this->getUserId());
            $stmt->bindValue('userEmail', $this->getUserEmail());
            $stmt->bindValue('userPass', $this->getUserPass());
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deleteUser($user_code)
    {
        try {
            $sql = 'DELETE FROM usuarios WHERE user_code = :user_code';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('user_code', $user_code);
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
