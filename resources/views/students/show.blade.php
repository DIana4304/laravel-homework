@extends('layouts.app')

@section('title', 'Студент: ' . $student->surname . ' ' . $student->name)

@section('content')
    <nav class="breadcrumbs">
        <a href="{{ route('groups.index') }}">Все группы</a>
        <span>/</span>
        <a href="{{ route('groups.show', $group) }}">{{ $group->title }}</a>
        <span>/</span>
        <span>Студент #{{ $student->id }}</span>
    </nav>

    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header-flex">
            <div>
                <h1>{{ $student->surname }} {{ $student->name }}</h1>
                <p class="text-muted">Полная информация о студенте из базы данных</p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('groups.show', $group) }}" class="btn btn-secondary">
                    ← К группе {{ $group->title }}
                </a>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">ID студента (id)</div>
                <div class="info-value">#{{ $student->id }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">ID группы (group_id)</div>
                <div class="info-value">#{{ $student->group_id }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Фамилия (surname)</div>
                <div class="info-value">{{ $student->surname }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Имя (name)</div>
                <div class="info-value">{{ $student->name }}</div>
            </div>

            <div class="info-item" style="grid-column: span 2;">
                <div class="info-label">Учебная группа</div>
                <div class="info-value">
                    <a href="{{ route('groups.show', $group) }}" style="color: var(--primary); text-decoration: none;">
                        {{ $group->title }} (Начало: {{ $group->start_from->format('Y-m-d') }})
                    </a>
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Дата добавления (created_at)</div>
                <div class="info-value" style="font-size: 0.95rem;">
                    {{ $student->created_at ? $student->created_at->format('Y-m-d H:i:s') : '—' }}
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Дата обновления (updated_at)</div>
                <div class="info-value" style="font-size: 0.95rem;">
                    {{ $student->updated_at ? $student->updated_at->format('Y-m-d H:i:s') : '—' }}
                </div>
            </div>
        </div>

        <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('groups.show', $group) }}" class="btn btn-secondary">
                ← Вернуться к группе «{{ $group->title }}»
            </a>
            <a href="{{ route('groups.index') }}" class="btn btn-secondary">
                Все учебные группы
            </a>
        </div>
    </div>
@endsection
