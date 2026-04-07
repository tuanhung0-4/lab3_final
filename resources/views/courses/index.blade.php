@extends('layouts.master')

@section('title', 'Quản lý khóa học')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Khóa học</h1>
        <p>Xem và quản lý tất cả các khóa học của bạn.</p>
    </div>
    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('courses.trashed') }}" class="btn btn-outline" title="Thùng rác">
            <ion-icon name="trash-outline"></ion-icon>
        </a>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <ion-icon name="add-outline"></ion-icon>
            Thêm khóa học mới
        </a>
    </div>
</div>

<div class="card" style="margin-bottom: 2rem;">
    <form action="{{ route('courses.index') }}" method="GET" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr auto; gap: 1rem; align-items: end;">
        <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Tìm kiếm</label>
            <input type="text" name="search" class="form-control" placeholder="Tên khóa học..." value="{{ request('search') }}">
        </div>
        <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="">Tất cả</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Sắp xếp theo</label>
            <select name="sort_by" class="form-control">
                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Ngày tạo</option>
                <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Giá</option>
                <option value="lessons_count" {{ request('sort_by') == 'lessons_count' ? 'selected' : '' }}>Số bài học</option>
                <option value="students_count" {{ request('sort_by') == 'students_count' ? 'selected' : '' }}>Số học viên</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Thứ tự</label>
            <select name="order" class="form-control">
                <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Giảm dần</option>
                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Tăng dần</option>
            </select>
        </div>
        <button type="submit" class="btn btn-outline">Lọc</button>
    </form>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên khóa học</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Số bài học</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td>
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" class="img-preview">
                        @else
                            <div class="img-preview" style="background: var(--gray-200); display: flex; align-items: center; justify-content: center;">
                                <ion-icon name="image-outline"></ion-icon>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight: 600;">{{ $course->name }}</div>
                        <div style="font-size: 0.8rem; color: var(--secondary);">{{ $course->slug }}</div>
                    </td>
                    <td>{{ number_format($course->price, 0, ',', '.') }} đ</td>
                    <td><span class="badge badge-{{ $course->status }}">{{ $course->status }}</span></td>
                    <td>{{ $course->lessons_count }} bài học</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline" style="padding: 0.4rem; font-size: 1.2rem;" title="Sửa">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Xóa khóa học này?')">
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
                    <td colspan="6" style="text-align: center; color: var(--secondary); padding: 2rem;">Không tìm thấy khóa học nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 1.5rem;">
        {{ $courses->appends(request()->query())->links() }}
    </div>
</div>
@endsection
