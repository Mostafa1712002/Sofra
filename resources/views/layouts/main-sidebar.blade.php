<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll noPrint">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/') }}"><img
                src="{{ URL::asset('images/app/logo.png') }}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/') }}"><img
                src="{{ URL::asset('images/app/logo.png') }}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/') }}"><img
                src="{{ URL::asset('images/app/logo.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/') }}"><img
                src="{{ URL::asset('images/app/logo.png') }}" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="___class_+?14___">
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="{{ URL::asset('images/app/me.jpg') }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()->name }}</h4>
                    <span class="mb-0 text-muted">{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">تطبيق سفره</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/') }}">
                    <i class="icon ion-ios-home tx-20 ml-2 side-menu__icon"></i>
                    <span class="side-menu__label">الرئيسية</span></a>
            </li>

            <li class="side-item side-item-category">مكونات التطبيق</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                    <i class="fe fe-book-open side-menu__icon" viewBox="0 0 24 24"> </i>
                    <span class="side-menu__label">مكونات
                        التطبيق</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">

                    <li><a class="slide-item" href="{{ url('/' . ($page = 'order')) }}">الطلبات</a></li>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'payment')) }}">الدفعات</a></li>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'contact')) }}">الرسائل المستلمه</a>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'city')) }}">المدن</a></li>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'district')) }}">المناطق</a></li>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'category')) }}">الأقسام</a></li>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'offer')) }}">العروض</a></li>
                </ul>
            </li>

            <li class="side-item side-item-category">أعضاء التطبيق</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                    <i class="fa fa-users side-menu__icon" viewBox="0 0 24 24"> </i>
                    <span class="side-menu__label">أعضاء
                        التطبيق</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'restaurant')) }}">المطاعم</a></li>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'client')) }}">العملاء</a></li>
            </li>
        </ul>
        </li>



        <li class="side-item side-item-category"> الأعدادت</li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                <i class="mdi mdi-account-settings side-menu__icon" viewBox="0 0 24 24"> </i>
                <span class="side-menu__label">
                    الأعدادت</span><i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ url('/' . ($page = 'setting')) }}">الأعدادت العامه لتطبيق</a>
                </li>
        </li>
        </ul>
        </li>

        </ul>


</aside>


<!-- main-sidebar -->
