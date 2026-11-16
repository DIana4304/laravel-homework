@extends('layouts.app')

@section('title', 'Список групп')

@section('content')
    <div class="card">
        <div class="card-header-flex">
            <div>
                <h1>Список учебных групп</h1>
                <p class="text-muted">Всего групп в системе: {{ $groups->count() }}</p>
            </div>
            <div>
                <a href="{{ route('groups.create') }}" class="btn btn-primary">
                    + Создать новую группу
                </a>
            </div>
        </div>

        @if ($groups->isEmpty())
            <div class="empty-state">
                <p>Учебных групп пока не создано.</p>
                <a href="{{ route('groups.create') }}" class="btn btn-primary">
                    Создать первую группу
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название группы</th>
                            <th>Дата начала</th>
                            <th>Статус обучения</th>
                            <th>Студентов</th>
                            <th>Дата создания</th>
                            <th style="text-align: right;">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <td><strong>#{{ $group->id }}</strong></td>
                                <td>
                                    <a href="{{ route('groups.show', $group) }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">
                                        {{ $group->title }}
                                    </a>
                                </td>
                                <td>{{ $group->start_from->format('Y-m-d') }}</td>
                                <td>
                                    @if ($group->is_active)
                                        <span class="badge badge-success">● Обучение начато</span>
                                    @else
                                        <span class="badge badge-secondary">○ Не начато</span>
                                    @endif
                                </td>
                                <td>{{ $group->students_count }} чел.</td>
                                <td>{{ $group->created_at->format('Y-m-d H:i') }}</td>
                                <td style="text-align: right;">
                                    <a href="{{ route('groups.show', $group) }}" class="btn btn-secondary btn-sm">
                                        Просмотр →
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
