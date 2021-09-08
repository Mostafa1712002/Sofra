@extends('layouts.master')
@section('title')
إنشاء رتبة مستخدم
@endsection
@section('page-header')
    {{-- Page headerr --}}
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> إنشاء رتبة مستخدم جديده </h2>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <!-- .card -->
            <div class="card">




                <div class="card-body">
                    @include('flash::message')
                    {!! Form::open(['route' => 'role.store']) !!}
                    @include("roles.form")
                    <div class="form-group">
                        <button class="btn btn-info mt-3 mr-2 btn-md "> حفظ</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>



            <!-- /.card -->
        </div>
    </div>
    <!-- row close -->
</div>
</div>
@endsection
@push('js')
    <script>
        $("#select-all").click(function() {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });

        $("input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $("#select-all").prop("checked", false);
            }
        });
    </script>
@endpush
