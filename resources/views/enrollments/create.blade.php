@extends('layouts.master')

@section('title', 'Đăng ký khóa học')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Đăng ký khóa học</h1>
        <p>Ghi danh học viên vào một khóa học cụ thể.</p>
    </div>
    <a href="{{ route('enrollments.index') }}" class="btn btn-outline"> Quay lại </a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('enrollments.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Chọn khóa học</label>
            <select name="course_id" class="form-control" required>
                <option value="">-- Chọn khóa học --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->name }} ({{ number_format($course->price, 0, ',', '.') }} đ)
                    </option>
                @endforeach
            </select>
        </div>

        <hr style="margin: 2rem 0; border: none; border-top: 1px solid var(--gray-200);">

        <h3 style="margin-bottom: 1.5rem;">Thông tin học viên</h3>

        <div class="form-group">
            <label class="form-label">Tên học viên</label>
            <input type="text" name="student_name" class="form-control" value="{{ old('student_name') }}" placeholder="VD: Nguyễn Văn A" required>
        </div>

        <div class="form-group">
            <label class="form-label">Địa chỉ Email</label>
            <input type="email" name="student_email" class="form-control" value="{{ old('student_email') }}" placeholder="vd: student@gmail.com" required>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 1rem;">
                <ion-icon name="checkmark-done-outline"></ion-icon>
                Xác nhận đăng ký
            </button>
        </div>
    </form>
</div>
@endsection
