@extends('layouts.app')

@section('title', 'Создать группу')

@section('content')
    <nav class="breadcrumbs">
        <a href="{{ route('groups.index') }}">← Назад к списку групп</a>
        <span>/</span>
        <span>Создание группы</span>
    </nav>

    <div class="card" style="max-width: 650px; margin: 0 auto;">
        <div class="card-header-flex">
            <div>
                <h1>Создание новой группы</h1>
                <p class="text-muted">Заполните данные для добавления учебной группы</p>
            </div>
        </div>

        <form action="{{ route('groups.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">Название группы <span style="color: var(--danger);">*</span></label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    class="form-control"
                    value="{{ old('title') }}"
                    placeholder="Например: Группа FS-01"
                    required
                >
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="start_from" class="form-label">Дата начала обучения <span style="color: var(--danger);">*</span></label>
                <input
                    type="date"
                    name="start_from"
                    id="start_from"
                    class="form-control"
                    value="{{ old('start_from', date('Y-m-d')) }}"
                    required
                >
                @error('start_from')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-checkbox-label">
                    <input
                        type="checkbox"
                        name="is_active"
                        id="is_active"
                        value="1"
                        class="form-checkbox"
                        {{ old('is_active', true) ? 'checked' : '' }}
                    >
                    <span>Группа начала своё обучение (активна)</span>
                </label>
                @error('is_active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; gap: 12px; margin-top: 28px;">
                <button type="submit" class="btn btn-primary">
                    Создать группу
                </button>
                <a href="{{ route('groups.index') }}" class="btn btn-secondary">
                    Отмена
                </a>
            </div>
        </form>
    </div>
@endsection
