<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new Group();
        $group->name = 'Grupo 1';
        $group->description = 'Test grupo 1';
        $group->save();
        $group = new Group();
        $group->name = 'Grupo 2';
        $group->description = 'Test grupo 2';
        $group->save();
        $group = new Group();
        $group->name = 'Grupo 3';
        $group->description = 'Test grupo 3';
        $group->save();
    }
}
