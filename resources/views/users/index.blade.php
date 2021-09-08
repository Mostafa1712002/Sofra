@extends('layouts.master')

@section('title')
    قائمة المستخدمين - سفره
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة المستخدمين</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <b class="text-center">
        @include('flash::message')
    </b>
    <!-- row opened -->
    <div class="row ">
        <!--div-->
        <div class="col-xl-12">
            <div class=" @if (count($records)) card @endif mg-b-20">
                <div class="@if (count($records)) card-header @endif pb-0">
                    <div class="d-flex justify-content-center">
                        <h4 class="card-title mg-b-0">جدول المستخدمين </h4> <i
                            class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                    @if (auth()->user()->can("user-create"))
                    <div class="d-flex  justify-content-center mt-2 mb-2">
                        <a href="{{ route('user.create') }}" class=" btn-sm btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            إضافة مستخدم جديد
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
                                                    <th class="border-bottom-0 sorting_asc" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 137px;" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">#</th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">اسم المستخدم </th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;"> البريد الالكتروني </th>

                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">الرتبه</th>
                                                        @if (auth()->user()->can("user-edit")|| auth()->user()->can("user-destroy"))

                                                        <th class="text-center no-after" style=" width: 500px;"> العمليات</th>
                                                        @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($records as $record)
                                                    <tr role="row" class="odd" id="form{{ $record->id }}">

                                                        <td tabindex="0" class="sorting_1">{{ $loop->iteration }}
                                                        </td>
                                                        <td data-route="{{ route('user.update', $record->id) }}">
                                                            {{ $record->name }}</td>
                                                        <td>
                                                            {{ $record->email }}
                                                        </td>
                                                        <td>
                                                            @foreach ($record->roles->pluck('display_name') as $name)
                                                                <span class="bg-warning-gradient rounded-20">
                                                                    {{ $name }}</span>
                                                            @endforeach
                                                        </td>
                                                        @if (auth()->user()->can("user-destroy")|| auth()->user()->can("user-edit"))
                                                        <td class="text-center">
                                                            <div class="row">
                                                                @if (auth()->user()->can("user-edit"))

                                                                <div class="col-6">
                                                                    <a href="{{ route('user.edit', $record->id) }}"
                                                                        class=" btn btn-success btn-sm edit">
                                                                        <i class=" fas fa-edit"></i>
                                                                    </a>
                                                                </div>
                                                                @endif
                                                                @if (auth()->user()->can("user-destroy"))
                                                                <div class="col-6">
                                                                    <div data-token="{{ csrf_token() }}"
                                                                        data-id="{{ $record->id }}"
                                                                        data-route="{{ route('user.destroy', $record->id) }}"
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
        </div>
    @else
        <div class="alert alert-danger text-center " role="alert">
            <strong>لا يوجد مستخدمين</strong>
        </div>
        @endif
    </div>
    <!-- /row -->
</div>
</div>
    <div style="height: 700px;">
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            // Edit Button
            $(".edit").each(function() {
                $(this).click(function() {
                    var $id = $(this).data("id");
                    var $name = $(`#form${$id} td:nth-child(2)`).text();
                    var $description = $(`#form${$id} td:nth-child(3) div `).data("desc");
                    var $route = $(`#form${$id} td:nth-child(2)`).data("route");
                    $("#name").val(`${$name}`);
                    $("#description").val(`${$description}`)
                    $("#formModel").attr("action", `${$route}`)
                });
            });

            // Show Descripation

            $(".showDesc").each(function() {
                $(this).click(function() {
                    var $desc = $(this).data("desc");
                    $.dialog({
                        title: 'الوصف',
                        content: $desc,
                        type: 'blue',
                        backgroundDismiss: function() {
                            return true;
                        },
                        closeAnimation: "scale",
                        columnClass: 'col-6 ',
                        draggable: true,
                    });


                })
            });
        })
    </script>
@endpush
