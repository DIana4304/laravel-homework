@extends('layouts.app')

@section('title', 'Группа: ' . $group->title)

@section('content')
    <nav class="breadcrumbs">
        <a href="{{ route('groups.index') }}">← Назад ко всем группам</a>
        <span>/</span>
        <span>{{ $group->title }}</span>
    </nav>

    <!-- Информация о группе (вся информация из БД) -->
    <div class="card">
        <div class="card-header-flex">
            <div>
                <h1>{{ $group->title }}</h1>
                <p class="text-muted">Полная информация об учебной группе из базы данных</p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('groups.students.create', $group) }}" class="btn btn-primary">
                    + Добавить студента
                </a>
                <a href="{{ route('groups.index') }}" class="btn btn-secondary">
                    ← К списку групп
                </a>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">ID группы (id)</div>
                <div class="info-value">#{{ $group->id }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Название (title)</div>
                <div class="info-value">{{ $group->title }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Дата начала обучения (start_from)</div>
                <div class="info-value">{{ $group->start_from->format('Y-m-d') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Статус активности (is_active)</div>
                <div class="info-value">
                    @if ($group->is_active)
                        <span class="badge badge-success">● Активна (обучение начато)</span>
                    @else
                        <span class="badge badge-secondary">○ Не активна (обучение не начато)</span>
                    @endif
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Дата создания (created_at)</div>
                <div class="info-value" style="font-size: 0.95rem;">
                    {{ $group->created_at ? $group->created_at->format('Y-m-d H:i:s') : '—' }}
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Дата обновления (updated_at)</div>
                <div class="info-value" style="font-size: 0.95rem;">
                    {{ $group->updated_at ? $group->updated_at->format('Y-m-d H:i:s') : '—' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Список студентов выбранной группы -->
    <div class="card">
        <div class="card-header-flex">
            <div>
                <h2>Студенты группы «{{ $group->title }}»</h2>
                <p class="text-muted">Всего студентов в группе: {{ $group->students->count() }}</p>
            </div>
            <div>
                <a href="{{ route('groups.students.create', $group) }}" class="btn btn-primary btn-sm">
                    + Добавить студента
                </a>
            </div>
        </div>

        @if ($group->students->isEmpty())
            <div class="empty-state">
                <p>В этой группе пока нет ни одного студента.</p>
                <a href="{{ route('groups.students.create', $group) }}" class="btn btn-primary">
                    Добавить первого студента
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Дата добавления</th>
                            <th>Дата обновления</th>
                            <th style="text-align: right;">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($group->students as $student)
                            <tr>
                                <td><strong>#{{ $student->id }}</strong></td>
                                <td>
                                    <a href="{{ route('groups.students.show', [$group, $student]) }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">
                                        {{ $student->surname }}
                                    </a>
                                </td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->created_at ? $student->created_at->format('Y-m-d H:i:s') : '—' }}</td>
                                <td>{{ $student->updated_at ? $student->updated_at->format('Y-m-d H:i:s') : '—' }}</td>
                                <td style="text-align: right;">
                                    <a href="{{ route('groups.students.show', [$group, $student]) }}" class="btn btn-secondary btn-sm">
                                        Просмотр студента →
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
