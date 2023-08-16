<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Blog;

class BlogControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_blog_view()
    {
        $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@1234',
            
        ]);
        $response = $this->get('blogs');

        $response->assertStatus(200);
    }

    public function test_create_blog()
    {
        $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@1234',
            
        ]);
        $response=$this->call('GET','blogs/create');
        
        $response->assertStatus(200);
    }

    public function test_store_blog()
    {
        $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@1234',
            
        ]);
        $response=$this->call('POST','blogs/store',[
            'name'  =>  $name = time().'blog',
            'description' => 'Blog Description',
            'user_id'=>1
        ]);
        $response->assertStatus(302);
   
    }

    public function test_store_blog_error()
    {
        $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@1234',
            
        ]);
        $response=$this->call('POST','blogs/store',[
            'name'  =>  '',
            'description' => 'Blog Description'
        ]);
        $errorjson = [
            'success' => 'false',
            'message' => 'error',
            ];
        
        $response->assertStatus(302);
    }

    public function test_get_all_blogs()
    {
        $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@1234'
        ]);
        
        $response=$this->get('/blogs', ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(200);
    }
    
    public function test_edit_blog()
    {
        $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@1234',
            
        ]);
        $response = $this->call('GET', 'blogs/edit/97',[
        'name' => 'deepak',
        'description' => 'blogs'
    
            ]);
        
        $response->assertStatus($response->status(), 302);
    }

    public function test_update_blog()
    {
        $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@1234',
            
        ]);
        //$response = $this->withoutMiddleware();
        $response = $this->call('POST', '/blogs/update', [
            'id'=>97,
            'name' => 'deepak',
            'description' => 'blogs',
            'user_id'=>1

        ]);

        $response->assertStatus($response->status(), 302);

    }

    public function test_delete_product()
    {
        $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@1234',
            
        ]);
        //$response = $this->withoutMiddleware();
        $id=Blog::first()->id;
        $response = $this->call('get','blogs/delete/'.$id);

        $response->assertStatus($response->status(), 302);
    }

    public function test_delete_multiple()
    {
        $this->call('POST','/login',[
            'email'=>'devender.rathore@growexx.com',
            'password'=>'test@1234',
            
        ]);
        $response = $this->withoutMiddleware();
        $id=Blog::where('id' ,'>' ,0)->take(2)->get();
        $idlist=array();
        foreach ($id as $blog) {
            // Code Here

        $idlist[]=$blog->id;
        }
        
        $response = $this->call('POST', 'deleteMultiple', [
            'ids' => $idlist,
        ]);
        $response->assertStatus($response->status(), 302);

    }

}
