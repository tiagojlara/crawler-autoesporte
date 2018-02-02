<?php

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase {

    /**
     * @var \TestGlobo\Services\Auth
     */
    protected $auth;

    public function setUp()
    {
        $this->auth = new \TestGlobo\Services\Auth();
        parent::setUp();
    }

    public function testCreateUser()
    {
        $user = $this->auth->createUser('test', 'test');
        $this->assertArrayHasKey('test', $user);
    }

    public function testValidatePass()
    {
        $user = $this->auth->createUser('test', 'test');
        $this->assertArrayHasKey('test', $user);
    }

    public function testGeneratePass()
    {
        $pass = $this->auth->generatePassword('test');
        $this->assertStringStartsWith('$', $pass);
        $this->assertTrue($this->auth->checkPassWord('test', $pass));
    }

}