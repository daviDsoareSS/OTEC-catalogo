<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AcompanheTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create([
            'username' => 'adm'
        ]);

        $data = [
            'title' => 'seila',
            'subtitle' => 'teste',
            'author' => 'autor',
            'text' => 'asd',
            'image' => 'image.png',
        ];

        $response = $this->actingAs($user)->post('/adm/acompanhe', $data);

        $response->assertStatus(200);
    }
}
