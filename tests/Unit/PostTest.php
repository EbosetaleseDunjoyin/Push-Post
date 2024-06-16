<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
    
    /**
     * test_post_creation
     *
     * @test
     */
    protected $testUserEmail;

    public function test_post_duplication(): void
    {
        
        $this->testUserEmail = 'damsas' . Str::random(5) . '@test.com';
        $user = User::create([
            'name' => 'Test User',
            'email' => $this->testUserEmail,
            'password' => Hash::make('1234567890'),
        ]);

        
        $this->assertNotNull($user);
        $this->assertDatabaseHas('users', ['email' => $user->email]);

        
        $post1 = Post::create([
            'user_id' => $user->id,
            'title' => 'Post ' . Str::random(10),
            'body' => Str::random(50),
        ]);

        
        $post2 = Post::create([
            'user_id' => $user->id,
            'title' => 'Post ' . Str::random(10),
            'body' => Str::random(50),
        ]);

        
        $this->assertNotNull($post1);
        $this->assertNotNull($post2);
        $this->assertDatabaseHas('posts', ['id' => $post1->id]);
        $this->assertDatabaseHas('posts', ['id' => $post2->id]);

        
        $this->assertTrue($post1->title != $post2->title);
    }

    protected function tearDown(): void
    {
        // Find the created user by their email and delete their posts and the user
        if ($this->testUserEmail) {
            $user = User::where('email', $this->testUserEmail)->first();
            if ($user) {
                $user->posts()->delete();
                $user->delete();
            }
        }

        parent::tearDown(); // Call parent's tearDown method
    }
}
