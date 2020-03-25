<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 15)->create();
        factory(App\Group::class, 3)->create();
        factory(App\AccessCode::class, 10)->create();
        factory(App\Book::class, 20)->create();
    }
}
