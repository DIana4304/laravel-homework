@extends('layouts.app')

@section('title', 'Добавить студента — ' . $group->title)

@section('content')
    <nav class="breadcrumbs">
        <a href="{{ route('groups.index') }}">Все группы</a>
        <span>/</span>
        <a href="{{ route('groups.show', $group) }}">{{ $group->title }}</a>
        <span>/</span>
        <span>Добавление студента</span>
    </nav>

    <div class="card" style="max-width: 650px; margin: 0 auto;">
        <div class="card-header-flex">
            <div>
                <h1>Добавление студента</h1>
                <p class="text-muted">Группа: <strong>{{ $group->title }}</strong> (ID: {{ $group->id }})</p>
            </div>
        </div>

        <form action="{{ route('groups.students.store', $group) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="surname" class="form-label">Фамилия студента <span style="color: var(--danger);">*</span></label>
                <input
                    type="text"
                    name="surname"
                    id="surname"
                    class="form-control"
                    value="{{ old('surname') }}"
                    placeholder="Например: Петров"
                    required
                >
                @error('surname')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Имя студента <span style="color: var(--danger);">*</span></label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="Например: Иван"
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; gap: 12px; margin-top: 28px;">
                <button type="submit" class="btn btn-primary">
                    Добавить студента
                </button>
                <a href="{{ route('groups.show', $group) }}" class="btn btn-secondary">
                    ← Назад к группе
                </a>
            </div>
        </form>
    </div>
@endsection
