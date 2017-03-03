<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     *
     * //['email' => 'administrador@editora.com'],
    //['email' => 'autor@editora.com'],
    //['email' => 'usuario@editora.com']
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CodeEduUser\Models\User::class, 1)->create([
            'email' => 'autor1@editora.com'
        ]);


        factory(\CodeEduUser\Models\User::class, 1)->create([
            'email' => 'autor2@editora.com'
        ]);

        factory(\CodeEduUser\Models\User::class, 1)->create([
            'email' => 'autor3@editora.com'
        ]);

        factory(\CodeEduUser\Models\User::class, 1)->create([
            'email' => 'autor4@editora.com'
        ]);

        factory(\CodeEduUser\Models\User::class, 1)->create([
            'email' => 'admin@editora.com',
            'name' => 'Carlos Henrique Alves',
        ]);

        $author = factory(\CodeEduUser\Models\User::class, 1)->states('author')->create();
        $roleAuthor = \CodeEduUser\Models\Role::where('name', config('codeedubook.acl.role_author'))->first();
        $author->roles()->attach($roleAuthor->id);



    }
}