@extends('layouts.master')

@section('title', 'Thùng rác khóa học')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Thùng rác</h1>
        <p>Khôi phục hoặc xóa vĩnh viễn các khóa học đã xóa tạm thời.</p>
    </div>
    <a href="{{ route('courses.index') }}" class="btn btn-outline"> Quay lại </a>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Tên khóa học</th>
                    <th>Ngày xóa</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td>
                        <div style="font-weight: 600;">{{ $course->name }}</div>
                    </td>
                    <td>{{ $course->deleted_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('courses.restore', $course->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="padding: 0.4rem 1rem;">
                                <ion-icon name="refresh-outline"></ion-icon>
                                Khôi phục
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: var(--secondary); padding: 2rem;">Thùng rác trống.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top: 1rem;">
        {{ $courses->links() }}
    </div>
</div>
@endsection
