<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterNewUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_new_user_is_stored_to_the_database()
    {
        $response = $this->post('/api/register', [
            'name' => 'Khadijat',
            'email' => 'myemail@email.co.uk',
            'password' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Khadijat',
            'email' => 'myemail@email.co.uk',
        ]);
    }

    public function test_the_post_request_is_successful()
    {
        $response = $this->post('/api/register', [
            'name' => 'Khadijat',
            'email' => 'myemail@email.co.uk',
            'password' => 'password',
        ]);

        $response->assertSuccessful();
    }

    public function test_the_email_is_unique()
    {
        $this->postJson('api/register', [
            'name' => 'Dan',
            'email' => 'hello@dan.com',
            'password' => 'password',

         ])->assertSuccessful();

         $this->postJson('api/register', [
             'name' => 'Dan',
             'email' => 'hello@dan.com',
             'password' => 'password',

         ])->assertStatus(422);
    }
}
