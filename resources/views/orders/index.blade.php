@extends('layouts.master')

@section('title')
    قائمة الطلبات - سفره
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة الطلبات</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">عملية فلترة لطلبات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'get', 'route' => 'order.index']) !!}
                    <div class="form-group">
                        {!! Form::text('client', null, ['class' => 'form-control', 'placeholder' => 'فلترة باسم العميل']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('restaurant', null, [
    'class' => 'form-control',
    'placeholder' => 'فلترة باسم
                                                                                                    المطعم',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'فلترة بالعنوان ']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('state', 'اختر حالة الطلب') !!}
                        <select class="form-control" name="state" id="state">
                            <option selected disabled>أختر الحاله</option>
                            <option value="pending">معلقه</option>
                            <option value="accepted">قبلها المطعم</option>
                            <option value="rejected">رفضها المطعم</option>
                            <option value="client_deliverd">تم إرساله للعميل</option>
                            <option value="finished">قبلها العميل</option>
                            <option value="declined">رفضها العميل</option>
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::label('payment_method', 'طريقة الدفع') !!}
                        <select class="form-control" name="payment_method" id="state">
                            <option selected disabled>أختر طريقة الدفع </option>
                            <option value="cash">نقداً</option>
                            <option value="online">أونلاين</option>

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
                        <h4 class="card-title mg-b-0">جدول الطلبات </h4> <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        <p type="button" class="btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            فلترة الطلبات
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
                                                    <th class="border-bottom-0 text-center sorting_asc" tabindex="0"
                                                        rowspan="1" colspan="1" style="width: 137px;" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">#</th>
                                                    <th class="border-bottom-0 text-center sorting" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 500px;">اسم العميل </th>
                                                    <th class="border-bottom-0 text-center sorting" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 500px;">اسم المطعم </th>
                                                    <th class="border-bottom-0 text-center sorting" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 500px;">حالة الطلب </th>
                                                    <th class="border-bottom-0 text-center sorting" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 500px;">طريقة الدفع</th>

                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">العنوان</th>
                                                    <th class=" no-after border-bottom-0 sorting" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 500px;">معلومات أكثر </th>

                                                    <th class="border-bottom-0 text-center no-after sorting" tabindex="0"
                                                        rowspan="1" colspan="1" style="width: 800px;">
                                                        <b>حذف</b>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($records as $record)
                                                    <tr role="row" class="odd" id="form{{ $record->id }}">

                                                        <td tabindex="0" class="sorting_1">{{ $loop->iteration }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $record->client->name }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $record->restaurant->name }}</td>

                                                        <td class="text-center tx-12" style="color: white">
                                                            @switch($record->state)
                                                            @case('pending')
                                                                <span class="bg-dark p-1 rounded ">معلقه</span>
                                                            @break
                                                            @case('accepted')
                                                                <span class="bg-secondary p-1 rounded">قبلها المطعم</span>
                                                            @break
                                                            @case('rejected')
                                                                <span class="bg-warning p-1 rounded">رفضها المطعم</span>
                                                            @break
                                                            @case('client_delivered')
                                                                <span class="bg-info p-1 rounded"> تم إرساله للعميل</span>
                                                            @break
                                                            @case('declined')
                                                                <span class="bg-danger p-1 rounded">رفضها العميل</span>
                                                            @break
                                                            @case('finished')
                                                                <span class="bg-success p-1 rounded">قبلها العميل</span>
                                                            @break
                                                        @endswitch

                                                        </td>
                                                        <td class="text-center">
                                                            @if ($record->payment_method == 'cash')
                                                                <span class="bg-success-gradient p-1 rounded-20">نقداً
                                                                </span>
                                                            @else
                                                                <span class=" bg-warning-gradient  p-1 rounded-20">
                                                                    أونلاين</span>
                                                            @endif
                                                        </td>

                                                        <td class="text-center">{{ $record->address }}</td>
                                                        <td class="text-center">
                                                            <a class="btn-sm btn-info"
                                                                href="{{ route('order.show', $record->id) }}">
                                                                المزيد....</a>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="row">
                                                                <div class="col-12 text-center  ">
                                                                    <div data-token="{{ csrf_token() }}"
                                                                        data-id="{{ $record->id }}"
                                                                        data-route="{{ route('order.destroy', $record->id) }}"
                                                                        class="btn btn-danger btn-sm" id="destroy">
                                                                        <i class="fas fa-trash "></i>
                                                                    </div>
                                                                </div>

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
        <strong>لا توجد طلبات </strong>
    </div>
    @endif
    <div style="height: 500px;">
    </div>
    <!-- /row -->
@endsection
