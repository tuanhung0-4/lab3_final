@extends('layouts.master')

@section('title', 'Chỉnh sửa bài học')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Chỉnh sửa bài học</h1>
        <p>Cập nhật thông tin cho bài học: {{ $lesson->title }}</p>
    </div>
    <a href="{{ route('lessons.index', ['course_id' => $lesson->course_id]) }}" class="btn btn-outline"> Quay lại </a>
</div>

<div class="card">
    <form action="{{ route('lessons.update', $lesson) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label">Chọn khóa học</label>
            <select name="course_id" class="form-control" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $lesson->course_id) == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Tiêu đề bài học</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $lesson->title) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Thứ tự (Order)</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $lesson->order) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Video URL</label>
            <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $lesson->video_url) }}" placeholder="https://youtube.com/...">
        </div>

        <div class="form-group">
            <label class="form-label">Nội dung bài học</label>
            <textarea name="content" class="form-control" rows="8">{{ old('content', $lesson->content) }}</textarea>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Cập nhật bài học</button>
        </div>
    </form>
</div>
@endsection
