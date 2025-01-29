<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Login', function () {

    it('allows a user to login with username', function () {
        // 1. Crear un usuario de prueba
        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => bcrypt('password123'),
        ]);

        // 2. Intentar iniciar sesión con el username y contraseña
        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'password123',
        ]);

        // 3. Verificar que el usuario está autenticado
        $this->assertAuthenticatedAs($user);

        // 4. Verificar que se redirige a la página correcta
        $response->assertRedirect('/dashboard'); // Cambia '/home' por la ruta a la que redirige tu aplicación después del login
    });

    it('does not allow a user to login with invalid credentials', function () {
        // 1. Crear un usuario de prueba
        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => bcrypt('password123'),
        ]);

        // 2. Intentar iniciar sesión con credenciales incorrectas
        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'wrongpassword',
        ]);

        // 3. Verificar que el usuario no está autenticado
        $this->assertGuest();

        // 4. Verificar que se muestra un mensaje de error
        $response->assertSessionHasErrors('username');
    });

});
