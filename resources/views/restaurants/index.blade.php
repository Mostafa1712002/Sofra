@extends('layouts.master')

@section('title')
    قائمة المطاعم - سفره
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المطاعم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة المطاعم</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">عملية فلترة لمطاعم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'get', 'route' => 'restaurant.index']) !!}
                    <div class="form-group">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'فلترة باسم المطعم']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'فلترة بالبريد الألكتروني للمطعم']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'فلترة برقم  الجوال']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'فلترة باسم المدينه']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('district', null, ['class' => 'form-control', 'placeholder' => 'فلترة باسم المنطقه']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('active', 'فلتره حسب الحاله') !!}
                        <select name="active" class="form-control">
                            <option selected disabled>أختر الحاله</option>
                            <option value="0">غير نشط</option>
                            <option value="1">نشط</option>

                        </select>
                    </div>



                    <button class="btn btn-success"> فلتره</button>
                    {!! Form::close() !!}



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <!-- row opened -->
    <div class="row ">
        <!--div-->
        <div class="col-xl-12">
            <div class=" @if (count($records)) card @endif mg-b-20">
                <div class="@if (count($records)) card-header @endif pb-0">
                    <div class="d-flex justify-content-center">
                        <h4 class="card-title mg-b-0">جدول المطاعم </h4> <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        <p type="button" class="btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            فلترة المطاعم
                        </p>
                    </div>
                </div>
                @if (count($records))
                    <div class="card-body table-responsive">
                        <div>
                            <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example"
                                            class="table key-buttons text-md-nowrap dataTable no-footer dtr-inline"
                                            role="grid" aria-describedby="example_info" style="width:100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="border-bottom-0 sorting_asc" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 137px;" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">#</th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">اسم المطعم </th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;"> البريد الالكتروني </th>

                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">رقم الجوال</th>

                                                    <th class=" no-after border-bottom-0 sorting" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 500px;">صورة الغلاف</th>

                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">اسم المدينه </th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">اسم المنطقه </th>

                                                    <th class=" no-after border-bottom-0 sorting" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 500px;">معلومات أكثر </th>
                                                    <th class="border-bottom-0 no-after sorting" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 800px;"> حذف <b
                                                            class="text-secondary">|</b>
                                                        التنشيط</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($records as $record)
                                                    <tr role="row" class="odd" id="form{{ $record->id }}">

                                                        <td tabindex="0" class="sorting_1">{{ $loop->iteration }}
                                                        </td>
                                                        <td>
                                                            {{ $record->name }}</td>
                                                        <td>
                                                            {{ $record->email }}
                                                        </td>
                                                        <td>{{ $record->phone }}</td>
                                                        <td>
                                                            <img src=" {{ $record->image }}" style="width:61px" />
                                                        </td>
                                                        <td>{{ $record->district->city->name }}</td>
                                                        <td>{{ $record->district->name }}</td>
                                                        <td class="text-center">
                                                            <a class="btn-sm btn-info"
                                                                href="{{ route('restaurant.show', $record->id) }}">
                                                                المزيد....</a>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div data-token="{{ csrf_token() }}"
                                                                        data-id="{{ $record->id }}"
                                                                        data-route="{{ route('restaurant.destroy', $record->id) }}"
                                                                        class="btn btn-danger btn-sm" id="destroy">
                                                                        <i class="fas fa-trash "></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6"
                                                                    id="active-div{{ $record->id }}">
                                                                    @if ($record->active == 1)
                                                                        <div style="cursor: pointer;"
                                                                            data-token="{{ csrf_token() }}"
                                                                            data-id="{{ $record->id }}"
                                                                            data-active="active"
                                                                            data-route="{{ route('restaurant.active') }}"
                                                                            class="active- text-info">
                                                                            <i class="fas fa-check"></i>
                                                                        </div>
                                                                    @else
                                                                        <div style="cursor: pointer;"
                                                                            data-token="{{ csrf_token() }}"
                                                                            data-id="{{ $record->id }}"
                                                                            data-active="de-active"
                                                                            data-route="{{ route('restaurant.active') }}"
                                                                            class="active- text-danger">
                                                                            <i class="fas fa-times"></i>
                                                                        </div>
                                                                </div>
                                                @endif
                                    </div>
                                </div>
                                </td>
                                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@else
    <div class="alert alert-danger text-center " role="alert">
        <strong>لا توجد مطاعم </strong>
    </div>
    @endif
    <div style="height: 500px;">
    </div>
    <!-- /row -->
@endsection

