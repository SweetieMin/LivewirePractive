<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserSeeder extends Seeder
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->userRepo->create([
            'name' => 'Nguyễn Khắc Huấn',
            'email' => 'huank@ice.edu.com',
            'username' => 'huannk',
            'account_code' => 'ICE00001',
            'status' => 'active',
            'password' => bcrypt('12345'),
            'must_change_password' => 0,
            'first_login_at' => now(),
            'last_password_change_at' => now(),
        ]);
    }
}
