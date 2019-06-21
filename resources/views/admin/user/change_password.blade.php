@extends('app.app')

@section('css')
    {{-- Additional CSS File for this page --}}
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Email & Password</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('password.change') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="changeEmail">Email</label>
                    <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}" id="changeEmail" required>
                </div>
                <div class="form-group">
                    <label for="oldpass">Password Saat Ini</label>
                    <input class="form-control" type="password" name="oldpass" id="oldpass" required>
                </div>
                <div class="form-group">
                    <label for="newpass">Password Baru</label>
                    <input class="form-control" type="password" name="newpass" id="newpass" required>
                </div>
                <button class="btn btn-primary btn-icon-split" type="submit">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Perbarui</span>
                </button>
            </form>
        </div>
    </div>
    @php
    if ($errors->any()) {
        foreach ($errors->all() as $message)
        {
            toastr()->error($message, 'Error');
        }
    }
    @endphp

@endsection

@push('scripts')
    {{-- Additional JS File for this page --}}
@endpush