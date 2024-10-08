<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MyFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_example2(): void
    {
        $this->seed(); 
        $emailToCheck = 'test@example.com';
        $userCount = DB::table('users')->where('email', $emailToCheck)->count();
        $this->assertEquals(1, $userCount);
    }
}
