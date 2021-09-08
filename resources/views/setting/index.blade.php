@extends('layouts.master')
@section('title')
الأعدادت العامة - سفره
@endsection
{{-- Page headerr --}}
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">أعدادت التطبيق</h2>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <!-- card -->
        <div class="card">
            <!-- /.card-header -->
            <!-- card-body -->
            <div class="card-body">
                <b class="text-center">
                    @include('flash::message')
                </b>
                {!! Form::model($record, [
                'method' => 'post',
                'route' => 'setting.store',
                ]) !!}
                <div class="form-group">
                    {!! Form::label('about_us', ' عن التطبيق') !!}
                    {!! Form::textarea('about_us', null, [
                    'class' => 'form-control',
                    'id' => 'about_us',
                    'placeholder' => 'تعديل عن التطبيق ',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('commission', ' رسوم التطبيق') !!}
                    {!! Form::text('commission', null, [
                    'class' => 'form-control',
                    'id' => 'commission',
                    'placeholder' => 'تعديل رسوم التطبيق ',
                    ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('num_bank_alahli', 'رقم حساب البنك الاهلي') !!}
                    {!! Form::text('num_bank_alahli', null, [
                    'class' => 'form-control',
                    'id' => 'num_bank_alahli',
                    'placeholder' => 'تعديل رقم حساب بنك الاهلي ',
                    ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('num_bank_alahli', 'رقم حساب البنك الراجحي') !!}
                    {!! Form::text('num_bank_alrakhi', null, [
                    'class' => 'form-control',
                    'id' => 'num_bank_alrakhi',
                    'placeholder' => 'تعديل رقم حساب بنك الراجحي ',
                    ]) !!}
                </div>

                <button class="btn  btn-success">تعديل</button>
                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- row close -->
</div>
</div>
{{-- Row for fix smooth --}}
<div style="height: 500px">
</div>


@endsection
