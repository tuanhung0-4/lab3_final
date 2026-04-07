@extends('layouts.master')

@section('title', 'Chỉnh sửa khóa học')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Chỉnh sửa: {{ $course->name }}</h1>
        <p>Cập nhật thông tin chi tiết của khóa học.</p>
    </div>
    <a href="{{ route('courses.index') }}" class="btn btn-outline"> Quay lại </a>
</div>

<div class="card">
    <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label">Tên khóa học</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $course->name) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $course->slug) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Giá (VNĐ)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $course->price) }}" min="1" step="0.01" required>
        </div>

        <div class="form-group">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description', $course->description) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Ảnh hiện tại</label>
            @if($course->image)
                <div style="margin-bottom: 0.5rem;">
                    <img src="{{ asset('storage/' . $course->image) }}" style="max-width: 200px; border-radius: 8px;">
                </div>
            @endif
            <input type="file" name="image" class="form-control">
            <small style="color: var(--secondary);">Tải lên ảnh mới nếu muốn thay đổi.</small>
        </div>

        <div class="form-group">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Cập nhật khóa học</button>
        </div>
    </form>
</div>
@endsection
