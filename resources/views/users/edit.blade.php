@extends('layouts.master')
@section('title')
تعديل مستخدمين
@endsection
@section('page-header')
    {{-- Page headerr --}}
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> تعديل مستخدم </h2>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($record, ['route' => ['user.update', $record->id], 'method' => 'put']) !!}
                    @php
                        $word = 'تعديل';
                        $id = $record->roles->pluck("id");
                    @endphp
                    
                    @include('users.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>  
    <!-- row close -->
    {{-- Row for fix smooth --}}
    <div style="height: 200px">
    </div>
@endsection
@push("js")

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

