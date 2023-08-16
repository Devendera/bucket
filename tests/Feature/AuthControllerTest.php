<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_index()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_login_index()
    {
        $response= $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@1234',
            
        ]);
        $response = $this->get('/login');

        $response->assertStatus(302);
    }

    public function test_store_blog_error()
    {
        $response= $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@12345',
            
        ]);
        $response->assertStatus(302);
    }

    public function test_registration()
    {
        $response=$this->call('GET','registration');
        
        $response->assertStatus(200);
    }

    public function test_custom_registration_user()
    {
        $response=$this->call('POST','custom-registration',[
            'name'  =>  $name = time().'user',
            'email' => $email = time().'test@example.com',
            'password'=>'123456789',
        ]);
        $response->assertStatus(302);
    }

    public function test_custom_registration_user_error()
    {
        $response=$this->call('POST','custom-registration',[
            'name'  =>  $name = time().'users',
            'email' => $email = time().'@example.com',
            'password'=>'',
        ]);
        $errorjson = [
            'success' => 'false',
            'message' => 'error',
            ];
        
        $response->assertStatus(302);
    }

    public function test_signout()
    {
        $response= $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@1234',
            
        ]);
        
        $response = $this->get('/logout');

        $response->assertStatus(302);
    }
}
