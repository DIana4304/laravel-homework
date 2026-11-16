<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $group1 = Group::firstOrCreate(
            ['title' => 'Группа FS-01'],
            [
                'start_from' => '2023-01-10',
                'is_active' => true,
            ]
        );

        $group2 = Group::firstOrCreate(
            ['title' => 'Группа QA-02'],
            [
                'start_from' => '2023-03-01',
                'is_active' => true,
            ]
        );

        $group3 = Group::firstOrCreate(
            ['title' => 'Группа PY-03'],
            [
                'start_from' => '2023-09-15',
                'is_active' => false,
            ]
        );

        Student::firstOrCreate(
            [
                'group_id' => $group1->id,
                'surname' => 'Петров',
                'name' => 'Иван',
            ]
        );

        Student::firstOrCreate(
            [
                'group_id' => $group1->id,
                'surname' => 'Сидорова',
                'name' => 'Анна',
            ]
        );

        Student::firstOrCreate(
            [
                'group_id' => $group2->id,
                'surname' => 'Смирнов',
                'name' => 'Алексей',
            ]
        );
    }
}
