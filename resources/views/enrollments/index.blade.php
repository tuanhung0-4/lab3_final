@extends('layouts.master')

@section('title', 'Quản lý học viên đăng ký')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Học viên & Đăng ký</h1>
        <p>Theo dõi học viên đã đăng ký vào các khóa học.</p>
    </div>
    <a href="{{ route('enrollments.create') }}" class="btn btn-primary">
        <ion-icon name="person-add-outline"></ion-icon>
        Đăng ký học viên mới
    </a>
</div>

<div class="card" style="margin-bottom: 2rem;">
    <form action="{{ route('enrollments.index') }}" method="GET" style="display: flex; gap: 1rem; align-items: end;">
        <div class="form-group" style="margin-bottom: 0; flex: 1;">
            <label class="form-label">Xem danh sách học viên theo khóa học</label>
            <select name="course_id" class="form-control" onchange="this.form.submit()">
                <option value="">-- Chọn khóa học --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->name }} ({{ $course->students_count }} học viên)
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-outline">Xem</button>
    </form>
</div>

@if($selectedCourse)
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Học viên của khóa: {{ $selectedCourse->name }}</h2>
        <span class="badge badge-published" style="font-size: 1rem;">Tổng: {{ $selectedCourse->students->count() }} học viên</span>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Tên học viên</th>
                    <th>Email</th>
                    <th>Ngày đăng ký</th>
                </tr>
            </thead>
            <tbody>
                @forelse($selectedCourse->students as $student)
                <tr>
                    <td style="font-weight: 600;">{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->pivot->created_at ? $student->pivot->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: var(--secondary); padding: 2rem;">Chưa có học viên nào đăng ký khóa học này.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@else
<div class="card" style="text-align: center; padding: 4rem; color: var(--secondary);">
    <ion-icon name="people-circle-outline" style="font-size: 4rem; margin-bottom: 1rem;"></ion-icon>
    <p>Vui lòng chọn một khóa học để xem danh sách học viên đăng ký.</p>
</div>
@endif
@endsection
