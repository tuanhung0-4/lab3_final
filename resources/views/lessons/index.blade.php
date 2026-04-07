@extends('layouts.master')

@section('title', 'Quản lý bài học')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Bài học</h1>
        <p>Danh sách bài học theo từng khóa học.</p>
    </div>
    <a href="{{ route('lessons.create') }}" class="btn btn-primary">
        <ion-icon name="add-outline"></ion-icon>
        Thêm bài học mới
    </a>
</div>

<div class="card" style="margin-bottom: 2rem;">
    <form action="{{ route('lessons.index') }}" method="GET" style="display: flex; gap: 1rem; align-items: end;">
        <div class="form-group" style="margin-bottom: 0; flex: 1;">
            <label class="form-label">Chọn khóa học để xem bài học</label>
            <select name="course_id" class="form-control" onchange="this.form.submit()">
                <option value="">-- Chọn khóa học --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->name }} ({{ $course->lessons_count }} bài)
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-outline">Xem</button>
    </form>
</div>

@if($selectedCourse)
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Khóa học: {{ $selectedCourse->name }}</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">STT</th>
                    <th>Tiêu đề bài học</th>
                    <th>Video URL</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($selectedCourse->lessons as $lesson)
                <tr>
                    <td>{{ $lesson->order }}</td>
                    <td>
                        <div style="font-weight: 600;">{{ $lesson->title }}</div>
                    </td>
                    <td>{{ $lesson->video_url ?? 'N/A' }}</td>
                    <td>{{ $lesson->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-outline" style="padding: 0.4rem; font-size: 1.2rem;" title="Sửa">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" onsubmit="return confirm('Xóa bài học này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding: 0.4rem; font-size: 1.2rem; color: var(--danger);" title="Xóa">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--secondary); padding: 2rem;">Chưa có bài học nào cho khóa học này.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@else
<div class="card" style="text-align: center; padding: 4rem; color: var(--secondary);">
    <ion-icon name="play-outline" style="font-size: 4rem; margin-bottom: 1rem;"></ion-icon>
    <p>Vui lòng chọn một khóa học để xem danh sách bài học.</p>
</div>
@endif
@endsection
