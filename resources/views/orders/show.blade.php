@extends('layouts.master')

@section('title')
    تفاصيل الطلب - سفره
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto noPrint">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تفاصيل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الطلب
                    {{ $record->name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row ">
        <button type="button" id="printButton" class="btn noPrint btn-danger float-left mt-3 mr-2">
            <i class="mdi mdi-printer ml-1"></i>طباعه
        </button>
    </div>
    <div class="row row-sm" id="printForm">

        <div class="col-md-12 col-xl-12">

            <div class=" main-content-body-invoice">

                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h3> <i class="invoice-title">طلب.....</i></h3>

                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">الطلب الخاص ب </label>
                                <div class="billed-to">
                                    <h6>{{ $record->client->name }}</h6>

                                    <p>{{ $record->address }}<br>
                                        الهاتف: {{ $record->client->phone }} <br>
                                        الايميل: {{ $record->client->email }} </p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600"> التابع ل </label>
                                <div class="billed-to">
                                    <h6>{{ $record->restaurant->name }}</h6>

                                    <p>
                                        الهاتف: {{ $record->restaurant->phone }} <br>
                                        الايميل: {{ $record->restaurant->email }} </p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">معلومات الطلب </label>
                                <p class="invoice-info-row"><span>التكلفه </span> <span>{{ $record->cost }}</span></p>
                                <p class="invoice-info-row"><span>رسوم التوصيل </span>
                                    <span>{{ $record->delivery_cost }}</span>
                                </p>
                                <p class="invoice-info-row"><span>الضريبه </span> <span>{{ $record->commission }}</span>
                                </p>
                                <p class="invoice-info-row"><span>المجموع </span> <span>{{ $record->total }}</span></p>
                                <p class="invoice-info-row"><span>الباقي </span> <span>{{ $record->net }}</span></p>

                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">النوع</th>
                                        <th class="wd-40p">الوصف</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>حالة الطلب</td>
                                        <td class="tx-12">

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

                                    </tr>
                                    <tr>
                                        <td>طريقة الدفع</td>
                                        <td class="tx-12">
                                            @if ($record->payment_method == 'cash')
                                                <span class="bg-success-gradient p-1 rounded-20">نقداً
                                                </span>
                                            @else
                                                <span class=" bg-warning-gradient  p-1 rounded-20">
                                                    أونلاين</span>
                                            @endif
                                        </td>

                                    </tr>
                                    <tr>
                                    <tr>
                                        <td> ملاحظات</td>
                                        <td class="tx-12">
                                            <p>
                                                @if ($record->notes)
                                                    {{ $record->notes }}
                                                @else
                                                    <b class="bg-danger p-1 rounded"> لا توجد ملاحظات لهذا الطلب</b>
                                                @endif
                                            </p>
                                        </td>
                                    </tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">
                    </div>
                </div>
            </div>

        </div><!-- COL-END -->
    </div>
</div>
</div>
    <div style="height: 500px">
    </div>
@endsection
@push('css')
    <style media="screen">
    .noPrint{ display: block; }
    .yesPrint{ display: block !important; }
    </style>
    <style media="print">
        .noPrint {
            display: none;
        }

        .yesPrint {
            display: block !important;
        }

    </style>
@endpush
