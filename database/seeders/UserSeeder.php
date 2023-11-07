<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

use Faker\Generator;
use Illuminate\Container\Container;

class UserSeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminUsers();
        $this->createEmployeeUsers();

        // Create 100 random users
        for ($i = 0; $i < 200; $i++) {
            $this->CreateRandomUser();
        }
    }

    private function createAdminUsers(): void
    {
        // Create users
        User::factory()->create([
            'admin' => true,
            'level' => 99,
            'name' => 'JuanV',
            'username' => 'admin',
            'email' => 'JuanEscobarGT@outlook.com',
        ]);
    }

    private function createEmployeeUsers(string $roleName = 'employee'): void
    {
        $role = Role::findByName($roleName);

        // Create users
        $user = User::factory()->create([
            'level' => 10,
            'name' => 'RudeN',
            'username' => 'user1',
            'email' => 'preubecitas@gmail.com',
        ]);
        $user->assignRole($role);
    }

    private function CreateRandomUser(string $roleName = 'employee')
    {
        $role = Role::findByName($roleName);

        $user = User::factory()->create([
            'level' => 10,
            'name' => $this->faker->name,
            'username' => $this->faker->name,
            'email' => $this->faker->email
        ]);
        $user->assignRole($role);
    }
}
