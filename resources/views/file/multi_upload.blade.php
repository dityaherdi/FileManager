@extends('app.app')

@section('css')
    {{-- Additional CSS File for this page --}}
@endsection

@section('content')
    <!-- Page Heading -->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail</h1>
        <a href="#" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus-circle"></i>
            </span>
            <span class="text">Tombol</span>
        </a>
    </div> --}}

    {{-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" src="" alt="">
            </div>
        </div>
    </div> --}}

    <div class="jumbotron">
        {{-- <h1 class="display-4">Hello, world!</h1> --}}
        <div>
            <div class="row">
                <div class="col md-4 text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" src="{{ asset('img/file_default.svg') }}" style="width: 250px;" alt="">
                </div>
                <div class="col md-8">
                    <form action="{{ route('file.multi.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="files[]" multiple>
                        <button type="submit">
                            Upload
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
        {{-- <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p> --}}
        <hr class="my-4">
        {{-- <p>It uses utility classes for typography and spacing to space content out within the larger container.</p> --}}
        {{-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> --}}
    </div>

@endsection

@push('scripts')
    {{-- Additional JS File for this page --}}
@endpush