@extends('layouts.master')
@section('title')
    تغير كلمة مرور الحساب - سفره
@endsection
{{-- Page headerr --}}
@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">تغير كملة المرور </h2>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <b class="text-center">
        @include('flash::message')
    </b>
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <!-- .card -->
            <div class="card">
                <!-- card-body -->
                <div class="card-body">
                    {!! Form::open(['route' => 'user.password-update', 'method' => 'put']) !!}
                    {{-- Password Input --}}
                    <div class="form-group">
                        <div class="row ">
                            <div class="col-11">
                                {!! Form::label('كملة المرور') !!}
                                {!! Form::password('password', ['class' => 'form-control one']) !!}
                            </div>
                            <div class="col-1">
                                <div class="onefa" style=" margin: 40px -13px 0 0; ">
                                    <i class="fa fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Confirmation Password Input --}}
                    <div class="form-group">
                        <div class="row ">
                            <div class="col-11">
                                {!! Form::label('تأكيد كملة المرور ') !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control two ']) !!}
                            </div>
                            <div class="col-1">
                                <div class="twofa" style=" margin: 40px -13px 0 0; ">
                                    <i class=" fa fa-eye "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-info mt-3 btn-md "> حفظ</button>
                    {!! Form::close() !!}
                    <br>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- row close -->
    {{-- Row for fix smooth --}}
    <div style="height: 500px">
    </div>
@endsection

@push('js')
    <script>
        $(".onefa").click(function(e) {
            e.preventDefault();
            $(".onefa > i ").toggleClass("fa-eye fa-eye-slash");
            var input = $(".one");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }

        });
        $(".twofa").click(function(e) {
            e.preventDefault();
            $(".twofa >  i ").toggleClass("fa-eye fa-eye-slash");
            var input = $(".two");

            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }

        });
    </script>
@endpush
