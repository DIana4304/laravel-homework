<?php

namespace Tests\Feature;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupAndStudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_groups_index_page_displays_groups_and_create_link(): void
    {
        $group = Group::create([
            'title' => 'Группа FS-01',
            'start_from' => '2023-01-10',
            'is_active' => true,
        ]);

        $response = $this->get('/groups');

        $response->assertStatus(200);
        $response->assertSee('Группа FS-01');
        $response->assertSee(route('groups.create'));
    }

    public function test_groups_create_page_displays_form(): void
    {
        $response = $this->get('/groups/create');

        $response->assertStatus(200);
        $response->assertSee('Создание новой группы');
        $response->assertSee(route('groups.store'));
    }

    public function test_groups_store_creates_group_and_redirects_to_groups_index(): void
    {
        $response = $this->post('/groups', [
            'title' => 'Группа Новая-99',
            'start_from' => '2026-09-01',
            'is_active' => '1',
        ]);

        $response->assertRedirect(route('groups.index'));
        $group = Group::where('title', 'Группа Новая-99')->first();
        $this->assertNotNull($group);
        $this->assertEquals('2026-09-01', $group->start_from->format('Y-m-d'));
        $this->assertTrue($group->is_active);
    }

    public function test_groups_store_validation_errors(): void
    {
        $response = $this->post('/groups', [
            'title' => '',
            'start_from' => 'invalid-date',
        ]);

        $response->assertSessionHasErrors(['title', 'start_from']);
        $this->assertDatabaseCount('groups', 0);
    }

    public function test_groups_show_displays_group_details_and_student_list_and_create_student_link(): void
    {
        $group = Group::create([
            'title' => 'Группа FS-01',
            'start_from' => '2023-01-10',
            'is_active' => true,
        ]);

        $student = $group->students()->create([
            'surname' => 'Петров',
            'name' => 'Иван',
        ]);

        $response = $this->get("/groups/{$group->id}");

        $response->assertStatus(200);
        $response->assertSee('Группа FS-01');
        $response->assertSee('2023-01-10');
        $response->assertSee('Петров');
        $response->assertSee('Иван');
        $response->assertSee(route('groups.students.create', $group));
    }

    public function test_students_create_page_displays_form(): void
    {
        $group = Group::create([
            'title' => 'Группа FS-01',
            'start_from' => '2023-01-10',
            'is_active' => true,
        ]);

        $response = $this->get("/groups/{$group->id}/students/create");

        $response->assertStatus(200);
        $response->assertSee('Добавление студента');
        $response->assertSee(route('groups.students.store', $group));
    }

    public function test_students_store_creates_student_and_redirects_to_group_show(): void
    {
        $group = Group::create([
            'title' => 'Группа FS-01',
            'start_from' => '2023-01-10',
            'is_active' => true,
        ]);

        $response = $this->post("/groups/{$group->id}/students", [
            'surname' => 'Петров',
            'name' => 'Иван',
        ]);

        $response->assertRedirect(route('groups.show', $group));
        $this->assertDatabaseHas('students', [
            'group_id' => $group->id,
            'surname' => 'Петров',
            'name' => 'Иван',
        ]);
    }

    public function test_students_show_displays_student_details_and_back_links(): void
    {
        $group = Group::create([
            'title' => 'Группа FS-01',
            'start_from' => '2023-01-10',
            'is_active' => true,
        ]);

        $student = $group->students()->create([
            'surname' => 'Петров',
            'name' => 'Иван',
        ]);

        $response = $this->get("/groups/{$group->id}/students/{$student->id}");

        $response->assertStatus(200);
        $response->assertSee('Петров');
        $response->assertSee('Иван');
        $response->assertSee('Группа FS-01');
        $response->assertSee(route('groups.show', $group));
    }

    public function test_students_show_returns_404_if_student_does_not_belong_to_group(): void
    {
        $group1 = Group::create([
            'title' => 'Группа 1',
            'start_from' => '2023-01-10',
            'is_active' => true,
        ]);

        $group2 = Group::create([
            'title' => 'Группа 2',
            'start_from' => '2023-02-10',
            'is_active' => true,
        ]);

        $student2 = $group2->students()->create([
            'surname' => 'Сидоров',
            'name' => 'Олег',
        ]);

        $response = $this->get("/groups/{$group1->id}/students/{$student2->id}");

        $response->assertStatus(404);
    }
}
