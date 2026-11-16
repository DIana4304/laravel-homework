<?php

namespace Tests\Unit;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupAndStudentRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_group_has_many_students(): void
    {
        $group = Group::create([
            'title' => 'FS-01',
            'start_from' => '2023-01-10',
            'is_active' => true,
        ]);

        $student1 = $group->students()->create([
            'surname' => 'Петров',
            'name' => 'Иван',
        ]);

        $student2 = $group->students()->create([
            'surname' => 'Сидоров',
            'name' => 'Алексей',
        ]);

        $this->assertCount(2, $group->students);
        $this->assertTrue($group->students->contains($student1));
        $this->assertTrue($group->students->contains($student2));
    }

    public function test_student_belongs_to_group(): void
    {
        $group = Group::create([
            'title' => 'FS-01',
            'start_from' => '2023-01-10',
            'is_active' => true,
        ]);

        $student = Student::create([
            'group_id' => $group->id,
            'surname' => 'Петров',
            'name' => 'Иван',
        ]);

        $this->assertInstanceOf(Group::class, $student->group);
        $this->assertEquals($group->id, $student->group->id);
        $this->assertEquals('FS-01', $student->group->title);
    }
}
