<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_pantalla_login_es_visible()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_usuario_puede_autenticar_por_pantalla_con_email()
    {
        // $user = User::factory()->create();

        // Artisan::call('migrate');

        $user = User::factory()->create([
            'username' => 'username',
        ]);
        $response = $this->post('/login', [
            'identity' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_usuario_puede_autenticar_por_pantalla_con_username()
    {
        $user = User::factory()->create([
            'username' => 'username',
        ]);

        $response = $this->post('/login', [
            'identity' => $user->username,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_usuario_no_puede_autenticar_con_usuario_erroneo()
    {
        $user = User::factory()->create(
            [
                'username' => 'username',
            ]
        );

        $response = $this->post('/login', [
            'identity' => 'wrong-username',
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('identity');
       
    }

    public function test_usuario_no_puede_autenticar_con_email_erroneo()
    {
        $user = User::factory()->create(
            [
                'username' => 'username',
            ]
        );

        $response = $this->post('/login', [
            'identity' => 'asd@gmail.com',
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('identity');
    }

    public function test_usuario_no_puede_autenticar_con_contrasena_erronea()
    {
        $user = User::factory()->create(
            [
                'username' => 'username',
            ]
        );

        $response = $this->post('/login', [
            'identity' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('identity');
    }

    public function test_usuario_puede_cerrar_sesion()
    {
        $user = User::factory()->create(
            [
                'username' => 'username',
            ]
        );

        $this->be($user);

        $response = $this->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }

}
