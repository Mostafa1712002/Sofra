@extends('layouts.master')

@section('title')
    رتب المستخدمين - سفره
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">رتب المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة رتب المستخدمين</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <b class="text-center ">
        @include("flash::message")
    </b>
    <div class="row ">
        <!--div-->
        <div class="col-xl-12">
            <div class=" @if (count($records)) card @endif mg-b-20">
                <div class="@if (count($records)) card-header @endif pb-0">
                    <div class="d-flex justify-content-center">
                        <h4 class="card-title mg-b-0">جدول رتب المستخدمين </h4> <i
                            class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    @if (auth()->user()->can("role-create"))
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        <a href="{{ route('role.create') }}" class="btn-sm btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            إضافة رتبة مستخدم
                        </a>
                    </div>

                    @endif
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
                                                    <th class="border-bottom-0  sorting_asc" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 137px;" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">#</th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">اسم الربته </th>
                                                    <th class=" no-after border-bottom-0 sorting" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 500px;"> الوصف </th>
                                                    <th class="  border-bottom-0 sorting" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 500px;"> الاسم المعروض </th>
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
                                                        <td>{{ $record->name }}</td>
                                                        <td style="cursor: pointer"
                                                            data-desc="{{ $record->description }}">
                                                            <b class="btn-sm btn-info showDesc">الوصف</b>
                                                        </td>
                                                        <td>
                                                            <span class="bg-warning p-1 rounded-20" >
                                                                {{ $record->display_name }}
                                                            </span>
                                                        </td>
                                                        @if (auth()->user()->can("role-edit")|| auth()->user()->can("role-destroy"))
                                                        <td>
                                                            <div class="row">
                                                                @if (auth()->user()->can("role-edit"))
                                                                <div class="col-6">
                                                                    <a href="{{ route('role.edit', $record->id) }}"
                                                                        class=" btn btn-success btn-sm edit">
                                                                        <i class=" fas fa-edit"></i>
                                                                    </a>
                                                                </div>
                                                                @endif
                                                                @if (auth()->user()->can("role-destroy"))
                                                                <div class="col-6">
                                                                    <div data-token="{{ csrf_token() }}"
                                                                        data-id="{{ $record->id }}"
                                                                        data-route="{{ route('role.destroy', $record->id) }}"
                                                                        class="btn btn-danger btn-sm" id="destroy">
                                                                        <i class="fas fa-trash "></i>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                            </div>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $records->links('pagination::bootstrap-4') }}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        @else
            <div class="alert alert-danger text-center " role="alert">
                <strong>لا توجد رتب بعد </strong>
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
                        title: 'الوصف',
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
