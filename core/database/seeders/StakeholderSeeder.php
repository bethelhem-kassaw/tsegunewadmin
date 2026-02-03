<?php

namespace Database\Seeders;

use App\Models\Stakeholder;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StakeholderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user1 = Stakeholder::create([
            'first_name' => 'Michael',
            'last_name' => 'Getachew',
            'phone' => '0940678725',
            'email' => 'michaelgetachew5@gmail.com',
            'password' => '$2y$10$HQA6uxXGTAZPJityLRZqf.oZXXZ.N/a1FHmTsC6IEKc75C5maGuBG', //password
            'email_verified_at' => '2021-12-30 19:59:40',
        ]);
        $theRole = Role::where('slug', 'super-admin')->first()->id;
        $user1->roles()->attach($theRole);


        $user1 = Stakeholder::create([
            'first_name' => 'Admin',
            'last_name' => 'admin',
            'phone' => '0940673725',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$HQA6uxXGTAZPJityLRZqf.oZXXZ.N/a1FHmTsC6IEKc75C5maGuBG', //password
            'email_verified_at' => '2021-12-30 19:59:40',
        ]);
        $role1 = Role::where('slug', 'admin')->first()->id;
        $user1->roles()->attach($role1);

        $user2 = Stakeholder::create([
            'first_name' => 'Manager',
            'last_name' => 'manage',
            'phone' => '0940678725',
            'email' => 'manager@manager.com',
            'password' => '$2y$10$HQA6uxXGTAZPJityLRZqf.oZXXZ.N/a1FHmTsC6IEKc75C5maGuBG', //password
            'email_verified_at' => '2021-12-30 19:59:40',
        ]);
        $role2 = Role::where('slug', 'manager')->first()->id;
        $user2->roles()->attach($role2);

        $user4 = Stakeholder::create([
            'first_name' => 'Izrael',
            'last_name' => 'ad',
            'phone' => '0967676767',
            'email' => 'izrael@admin.com',
            'password' => Hash::make('default_pass'),
            'email_verified_at' => '2021-12-30 19:59:40',
        ]);
        $role1 = Role::where('slug', 'admin')->first()->id;
        $user4->roles()->attach($role1);
    }
}
