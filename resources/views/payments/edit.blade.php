@extends('layouts.master')
@section('title')
تعديل دفعه
@endsection
@section('page-header')
    {{-- Page headerr --}}
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> تعديل دفعه  </h2>
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
                    {!! Form::Model($record,[ "method" => "put" , "route" => ["payment.update",$record->id]]) !!}
                    @php
                        $word = ' تعديل';
                    @endphp
                    @include("payments.form")
                    {!! Form::close() !!}
                </div>

            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- row close -->
    {{-- Row for fix smooth --}}
    <div style="height: 200px">
    </div>
@endsection

