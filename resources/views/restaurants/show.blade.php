@extends('layouts.master')

@section('title')
تفاصيل المطعم-سفره
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المطعم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                {{ $record->name }}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row row-sm">
    <div class="col-lg-4">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="pl-0">
                    <div class="main-profile-overview">
                        <div class="main-img-user img-rounded  profile-user">
                            <img alt="" src="{{ asset("$record->image_restaurant") }}">
                        </div>
                        <div class="d-flex justify-content-between mg-b-20">
                            <div>
                                <h5 class="main-profile-name">{{ $record->name }}</h5>
                                <p class="main-profile-name-text">{{ $record->phone_restaurant }}</p>
                            </div>
                        </div>
                        <!-- main-profile-bio -->
                        <div class="row">
                            <div class="col-md-6 col mb20">
                                <h5>{{ $record->district->city->name }}</h5>
                                <h6 class="text-small text-muted mb-0">اسم المدينه</h6>
                            </div>

                            <div class="col-md-6 col mb20">
                                <h5>{{ $record->district->name }}</h5>
                                <h6 class="text-small text-muted mb-0">اسم المنطقه</h6>
                            </div>
                        </div>

                        <hr class="mg-y-30">
                        <label class="main-content-label tx-13 mg-b-20">التواصل</label>
                        <div class="main-profile-social-list">
                            <div class="media">
                                <div class="media-icon bg-primary-transparent text-success">
                                    <i class="icon ion-logo-whatsapp"></i>
                                </div>
                                <div class="media-body">
                                    <span>الواتس</span> <a href="">https://wa.me/{{ $record->whats_app }}</a>
                                </div>
                            </div>
                        </div>
                        <hr class="mg-y-30">
                    </div><!-- main-profile-overview -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="row row-sm">
            <div class="col-sm-12 col-xl-6 col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon bg-primary-transparent">
                                <i class="icon-layers text-primary"></i>
                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13">الطلبات</h5>
                                <h2 class="mb-0 tx-22 mb-1 mt-1">{{ count($record->orders->pluck('id')) }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6 col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon bg-success-transparent">
                                <i class="icon-rocket text-success"></i>

                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13">الحاله</h5>
                                <h2 class="mb-0 tx-22 mb-1 mt-1">
                                    @if ($record->state == 0)
                                    مغلق
                                    @else
                                    مفتوح
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="tabs-menu ">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                        <li class="active">
                            <a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i
                                        class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">
                                    ما يتعلق بالمطعم</span> </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                    <div class="tab-pane active" id="home">
                        <h4 class="tx-15 text-uppercase mb-3">الحد الأدني لطلب</h4>
                        <p class="m-b-5">{{ $record->minimum }} / جنيه</p>
                        <hr class="mg-y-30">
                        <h4 class="tx-15 text-uppercase mb-3">رسوم التوصيل</h4>
                        <p class="m-b-5">{{ $record->delivery_fee }} / جنيه</p>
                        <hr class="mg-y-30">
                        <h4 class="tx-15 text-uppercase mb-3">نشط ام لا </h4>
                        @if ($record->active==1)
                        <p style="color: white" class="m-b-5  text-center  rounded w-25  bg-success">
                            نشط
                        </p>
                        @else
                        <p style="color: white" class="m-b-5 text-center  rounded w-25 bg-danger">
                            غير نشط
                        </p>
                        @endif
                        <hr class="mg-y-30">

                        <h4 class="tx-15 text-uppercase mb-3">تم التسجيل في</h4>
                        <p class="m-b-5">{{ $record->created_at->format(" h:m A  Y-m-d  ") }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div style="height: 500px">
</div>
@endsection
