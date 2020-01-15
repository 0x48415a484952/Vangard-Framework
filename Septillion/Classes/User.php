<?php

namespace Septillion\Classes;
use Septillion\Classes\Model;

class User extends Model
{
    private const SELECT_USER_FROM_DATABASE = "SELECT * FROM users WHERE email=:email OR username=:username";
    private const INSERT_USER_INTO_DATABASE = "INSERT INTO users (email, username, password) VALUES(:email, :username, :password)";
    protected $email;
    protected $username;
    protected $password;

    public function setEmail($email)
    {
        $this->email = preg_replace('/\s+/', '', $email);
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setUsername($username)
    {
        $this->username = preg_replace('/\s+/', '', $username);
    }
    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }

    private function checkForExistingUsers()
    {
        $statement = $this->conn->prepare(self::SELECT_USER_FROM_DATABASE);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':username', $this->username);
        $statement->execute();
        return $statement->fetch();
    }


    public function login($email = null, $username = null, $password)
    {
        $this->setEmail($email);
        $this->setUsername($username);
        $this->setPassword($password);
        $fetchedUser = $this->checkForExistingUsers();
        if(password_verify($this->password, $fetchedUser['password'])) {
            setcookie('login_status', sha1($username), time() + (86400 * 30), "/", null, null, true);
            setcookie('is_admin', 0, time() + (86400 * 30), "/", null, null, true);
            if($fetchedUser['role_id'] == 1) setcookie('is_admin', 1, time() + (86400 * 30), "/", null, null, true);
        }
    }

    public function register($email, $username, $password, $confirmPassword)
    {
        $this->setEmail($email);
        $this->setUsername($username);
        $this->setPassword($password);
        $fetchedUser = $this->checkForExistingUsers();
        if($this->password == $confirmPassword && $fetchedUser == null) {
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
            $statement = $this->conn->prepare(self::INSERT_USER_INTO_DATABASE);
            $statement->execute([$this->email, $this->username, $this->password]);
        }
    }
}