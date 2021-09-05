@extends('layouts.master')

@section('title')
المدفوعات-سفره
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المدفوعات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                قائمة المدفوعات</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<b class="text-center">
    @include('flash::message')
</b>
<!-- Modal Filter -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">عملية فلترة لمدفوعات</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'get', 'route' => 'payment.index']) !!}
                <div class="form-group">
                    {!! Form::text('restaurant', null, ['class' => 'form-control', 'placeholder' => 'فلترة باسم
                    المطعم']) !!}
                </div>

                <div class="form-group">
                    {!! Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'فلترة بالملاحظات']) !!}
                </div>

                <div class="form-group">
                    {!! Form::text('paid', null, ['class' => 'form-control', 'placeholder' => 'فلترة بالمدفوع
                    ']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('payment_date', 'فتلرة بتاريخ الدفع') !!}
                    {!! Form::date('payment_date',null, ['id' => 'payment_date', 'class' => 'form-control']) !!}
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
<!-- / Modal Filter -->
<!-- row -->
<div class="row ">

    <!--div-->
    <div class="col-xl-12">
        <div class=" @if (count($records)) card @endif mg-b-20">
            <div class="@if (count($records)) card-header @endif pb-0">
                <div class="d-flex justify-content-center">
                    <h4 class="card-title mg-b-0">جدول المدفوعات </h4> <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <div class="d-flex justify-content-center mt-2 mb-2">
                    <p type="button" class="btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        فلترة المدفوعات
                    </p>
                </div>
                <div class="d-flex justify-content-center mt-2 mb-2">
                    <a type="button" href="{{ route("payment.create") }}"  style="color:white" class="btn-sm  btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        إضافة دفعه
                    </a>
                </div>
            </div>
            @if (count($records))
            <div class="card-body table-responsive">
                <div>
                    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example"
                                    class="table key-buttons text-md-nowrap dataTable no-footer dtr-inline" role="grid"
                                    aria-describedby="example_info" style="width:100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="border-bottom-0  sorting_asc" tabindex="0" rowspan="1"
                                                colspan="1" style="width: 137px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">#</th>
                                            <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                style="width: 500px;">اسم المطعم </th>
                                            <th class=" no-after border-bottom-0 sorting" tabindex="0" rowspan="1"
                                                colspan="1" style="width: 500px;"> ملاحظات </th>
                                            <th class=" no-after border-bottom-0 sorting" tabindex="0" rowspan="1"
                                                colspan="1" style="width: 500px;"> تاريخ الدفع </th>
                                            <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                style="width: 500px;"> المدفوع </th>
                                            <th class=" no-after border-bottom-0 sorting" tabindex="0" rowspan="1"
                                                colspan="1" style="width: 500px;"> العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($records as $record)
                                        <tr role="row" class="odd" id="form{{ $record->id }}">

                                            <td tabindex="0" class="sorting_1 text-center ">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $record->restaurant->name }}</td>
                                            <td style="cursor: pointer" data-desc="{{ $record->notes }}">
                                                <b class="btn-sm btn-info showDesc">ملاحظه</b>
                                            </td>
                                            <td>{{ $record->payment_date }}</td>
                                            <td>{{ $record->paid }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="{{ route("payment.edit" ,$record->id) }}"
                                                            class=" btn btn-success btn-sm edit">
                                                            <i class=" fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <div data-token="{{ csrf_token() }}" data-id="{{ $record->id }}"
                                                            data-route="{{ route('payment.destroy', $record->id) }}"
                                                            class="btn btn-danger btn-sm" id="destroy">
                                                            <i class="fas fa-trash "></i>
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
            <strong>لا توجد عروض بعد </strong>
        </div>
        @endif
        <div style="height: 500px;">
        </div>
    </div>
</div>
<!-- /row -->
@endsection
@push('js')
<script>
    $(function() {
            // Show Descripation
            $(".showDesc").each(function() {

                $(this).click(function() {
                    var $desc = $(this).parent().data("desc");

                    $.dialog({
                        title: 'الملاحظه',
                        content: $desc,
                        type: 'blue',
                        backgroundDismiss: function() {
                            return true;
                        },
                        closeAnimation: "scale",
                        columnClass: 'col-6 ',
                    });


                })
            });
        })
</script>
@endpush
