@extends('layouts.master')

@section('title', 'Thêm khóa học mới')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Thêm khóa học</h1>
        <p>Tạo một khóa học mới trong hệ thống.</p>
    </div>
    <a href="{{ route('courses.index') }}" class="btn btn-outline"> Quay lại </a>
</div>

<div class="card">
    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Tên khóa học</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Slug (Để trống để tự sinh)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
        </div>

        <div class="form-group">
            <label class="form-label">Giá (VNĐ)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', 0) }}" min="1" step="0.01" required>
        </div>

        <div class="form-group">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Ảnh khóa học</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Lưu khóa học</button>
        </div>
    </form>
</div>
@endsection
