@inject('users', 'App\Models\User')
@inject('roles', 'App\Models\Role')
@inject('clients', 'App\Models\Client')
@inject('restaurants', 'App\Models\Restaurant')
@inject('orders', 'App\Models\Order')
@inject('offers', 'App\Models\Offer')
@inject('contacts', 'App\Models\Contact')
@inject('payments', 'App\Models\Payment')
@inject('cities', 'App\Models\City')
@inject('districts', 'App\Models\District')
@inject('categories', 'App\Models\Category')
@extends('layouts.master')
@section('title')
    الصفحه الرئيسية-سفره
@endsection
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا بعودتك </h2>
                <p class="mg-b-0">لوحة التحكم في تطبيق سفره .</p>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
            <div class="card text-center">
                <div class="card-body ">
                    <div class="feature widget-2 text-center mt-0 mb-3">
                        <a href="{{ route('user.index') }}">
                            <i class="ti-user project bg-primary-transparent mx-auto text-primary "></i>
                        </a>
                    </div>
                    <h6 class="mb-1 text-muted">عدد المستخدمين</h6>
                    <h3 class="font-weight-semibold">{{ $users::all()->count('name') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
            <div class="card text-center">
                <div class="card-body ">
                    <div class="feature widget-2 text-center mt-0 mb-3">
                        <a href="{{ route('role.index') }}">
                            <i class="ti-pencil-alt project bg-pink-transparent mx-auto text-pink "></i>
                        </a>
                    </div>
                    <h6 class="mb-1 text-muted"> عدد الرتب </h6>
                    <h3 class="font-weight-semibold">{{ $roles::all()->count('name') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="feature widget-2 text-center mt-0 mb-3">
                        <a href="{{ route('client.index') }}">
                            <i class="ti-hand-stop project bg-teal-transparent mx-auto text-teal "></i>
                        </a>
                    </div>
                    <h6 class="mb-1 text-muted"> عدد العملاء </h6>
                    <h3 class="font-weight-semibold">{{ $clients::all()->count('name') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
            <div class="card text-center">
                <div class="card-body ">
                    <div class="feature widget-2 text-center mt-0 mb-3">
                        <a href="{{ route('restaurant.index') }}">

                            <i class="ti-shopping-cart project bg-success-transparent mx-auto text-success "></i>
                        </a>
                    </div>
                    <h6 class="mb-1 text-muted">عدد المطاعم</h6>
                    <h3 class="font-weight-semibold">{{ $restaurants::all()->count('name') }}</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
            <div class="card text-center">
                <div class="card-body ">
                    <div class="feature widget-2 text-center mt-0 mb-3">
                        <a href="{{ route('order.index') }}">
                            <i class="ti-package  project bg-primary-transparent mx-auto text-primary "></i>
                        </a>
                    </div>
                    <h6 class="mb-1 text-muted">عدد الطلبات</h6>
                    <h3 class="font-weight-semibold">{{ $orders::all()->count('name') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
            <div class="card text-center">
                <div class="card-body ">
                    <div class="feature widget-2 text-center mt-0 mb-3">
                        <a href="{{ route('offer.index') }}">
                            <i class="ti-stats-up project bg-pink-transparent mx-auto text-pink "></i>
                        </a>
                    </div>
                    <h6 class="mb-1 text-muted"> عدد العروض </h6>
                    <h3 class="font-weight-semibold">{{ $offers::all()->count('name') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="feature widget-2 text-center mt-0 mb-3">
                        <a href="{{ route('city.index') }}">
                            <i class="ti-direction-alt project bg-teal-transparent mx-auto text-teal "></i>
                        </a>
                    </div>
                    <h6 class="mb-1 text-muted"> عدد المدن </h6>
                    <h3 class="font-weight-semibold">{{ $cities::all()->count('name') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
            <div class="card text-center">
                <div class="card-body ">
                    <div class="feature widget-2 text-center mt-0 mb-3">
                        <a href="{{ route('district.index') }}">
                            <i class="ti-direction project bg-success-transparent mx-auto text-success "></i>
                        </a>
                    </div>
                    <h6 class="mb-1 text-muted">عدد المناطق</h6>
                    <h3 class="font-weight-semibold">{{ $districts::all()->count('name') }}</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
            <div class="card text-center">
                <div class="card-body ">
                    <div class="feature widget-2 text-center mt-0 mb-3">
                        <a href="{{ route('category.index') }}">
                            <i class="ti-layers-alt  project bg-primary-transparent mx-auto text-primary "></i>
                        </a>
                    </div>
                    <h6 class="mb-1 text-muted">عدد الاقسام</h6>
                    <h3 class="font-weight-semibold">{{ $categories::all()->count('name') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
            <div class="card text-center">
                <div class="card-body ">
                    <div class="feature widget-2 text-center mt-0 mb-3">
                        <a href="{{ route('contact.index') }}">
                            <i class="ti-comments project bg-pink-transparent mx-auto text-pink "></i>
                        </a>
                    </div>
                    <h6 class="mb-1 text-muted"> عدد الرسائل المستلمه </h6>
                    <h3 class="font-weight-semibold">{{ $contacts::all()->count('name') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12 col-sm-12 col-md-12">
            <div class="card text-center">
                <div class="card-body">
                    <div class="feature widget-2 text-center mt-0 mb-3">
                        <a href="{{ route('payment.index') }}">
                            <i class="ti-wallet project bg-teal-transparent mx-auto text-teal "></i>
                        </a>
                    </div>
                    <h6 class="mb-1 text-muted"> عدد المدفوعات </h6>
                    <h3 class="font-weight-semibold">{{ $payments::all()->count('name') }}</h3>
                </div>
            </div>
        </div>

    </div>
    <!-- /row -->
    {{-- To Fix smooth --}}
    <div style="height: 100px">
    </div>
</div>
</div>
@endsection
