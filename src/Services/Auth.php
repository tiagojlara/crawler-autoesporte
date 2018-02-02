<?php

namespace TestGlobo\Services;

class Auth 
{

    protected $users = [];

    /**
     *
     * @param string $user
     * @param string $pass
     * @return array
     */
    public function createUser(string $user, string $pass)
    {
        $this->users[$user] = $this->generatePassword($pass);
        return [$user => $this->users[$user]];
    }

    public function start() 
    {
        $user = $_SERVER['PHP_AUTH_USER'];
        $pass = $_SERVER['PHP_AUTH_PW'];

        if(!$this->checkPassWord($pass, $this->users[$user]))
        {
            header('HTTP/1.0 401 Unauthorized');
            echo 'Invalid Credentials';
            exit;
        }
    }

    /**
     *
     * @param string $pass
     * @return string
     */
    public function generatePassword(string $pass)
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    /**
     *
     * @param string $pass
     * @param string $hash
     * @return bool
     */
    public function checkPassWord(string $pass, string $hash)
    {
        return password_verify($pass, $hash);
    }

}

