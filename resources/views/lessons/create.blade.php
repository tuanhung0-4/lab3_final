@extends('layouts.master')

@section('title', 'Thêm bài học mới')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Thêm bài học</h1>
        <p>Thêm bài học mới vào khóa học.</p>
    </div>
    <a href="{{ route('lessons.index') }}" class="btn btn-outline"> Quay lại </a>
</div>

<div class="card">
    <form action="{{ route('lessons.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Chọn khóa học</label>
            <select name="course_id" class="form-control" required>
                <option value="">-- Chọn khóa học --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ (isset($selectedCourseId) && $selectedCourseId == $course->id) ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Tiêu đề bài học</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Thứ tự (Order)</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Video URL</label>
            <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}" placeholder="https://youtube.com/...">
        </div>

        <div class="form-group">
            <label class="form-label">Nội dung bài học</label>
            <textarea name="content" class="form-control" rows="8">{{ old('content') }}</textarea>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Lưu bài học</button>
        </div>
    </form>
</div>
@endsection
