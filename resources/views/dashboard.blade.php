@extends('layouts.master')

@section('title', 'Dashboard - Tổng quan hệ thống')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Dashboard</h1>
        <p>Chào mừng bạn trở lại, đây là tóm tắt hệ thống của bạn.</p>
    </div>
</div>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(99, 102, 241, 0.1); color: var(--primary);">
            <ion-icon name="book-outline"></ion-icon>
        </div>
        <div class="stat-info">
            <h3>Tổng khóa học</h3>
            <p>{{ $totalCourses }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--success);">
            <ion-icon name="people-outline"></ion-icon>
        </div>
        <div class="stat-info">
            <h3>Tổng học viên</h3>
            <p>{{ $totalStudents }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--warning);">
            <ion-icon name="cash-outline"></ion-icon>
        </div>
        <div class="stat-info">
            <h3>Tổng doanh thu</h3>
            <p>{{ number_format($totalRevenue, 0, ',', '.') }} đ</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--info);">
            <ion-icon name="star-outline"></ion-icon>
        </div>
        <div class="stat-info">
            <h3>Khóa học hot nhất</h3>
            <p>{{ $topCourse ? $topCourse->name : 'N/A' }}</p>
        </div>
    </div>
</div>

<div class="card">
    <h2 style="margin-bottom: 1.5rem;">5 Khóa học mới nhất</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Khóa học</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($newestCourses as $course)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" class="img-preview">
                            @else
                                <div class="img-preview" style="background: var(--gray-200); display: flex; align-items: center; justify-content: center;">
                                    <ion-icon name="image-outline"></ion-icon>
                                </div>
                            @endif
                            <span style="font-weight: 500;">{{ $course->name }}</span>
                        </div>
                    </td>
                    <td>{{ number_format($course->price, 0, ',', '.') }} đ</td>
                    <td><span class="badge badge-{{ $course->status }}">{{ $course->status }}</span></td>
                    <td>{{ $course->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: var(--secondary);">Chưa có khóa học nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
