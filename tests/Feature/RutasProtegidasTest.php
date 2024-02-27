<?php

namespace Tests\Feature;

use App\Models\User;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class RutasProtegidasTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_rutas_protegidas_sin_login(): void
    {
        $response = $this->get('/panel');
        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_rutas_protegidas_con_login(): void
    {
        Artisan::call('migrate');
        $user = User::factory()->create([
            'username' => 'username',]);

        //actingAs se utiliza para autenticar al usuario
        $response = $this->actingAs($user)->get('/panel');
        $response->assertStatus(200);
    }
}
