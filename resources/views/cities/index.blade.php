@extends('layouts.master')
@section('title')
    المدن - سفره
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الأعدادت</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة
                    مدينه </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- Modal Edit -->
    @if (auth()->user()->can('city-edit'))
        <div class="modal fade" id="edit" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLabel">
                            تعديل بياتات المدينه
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'formModel', 'method' => 'put']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'أسم المدينه') !!}
                            {!! Form::text('name', null, ['name' => 'name', 'id' => 'name', 'class' => 'form-control', 'placeholder' => 'تعديل أسم المدينه']) !!}

                        </div>
                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                        {!! Form::close() !!}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- / Modal Edit -->

    <!-- Modal ِAdd -->
    @if (auth()->user()->can('city-create'))
        <div class="modal fade" id="add" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLabel">
                            إضافة بياتات المدينه
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'formModel', 'route' => 'city.store', 'method' => 'post']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'أسم المدينه') !!}
                            {!! Form::text('name', null, ['name' => 'name', 'id' => 'name', 'class' => 'form-control', 'placeholder' => ' أسم المدينه']) !!}

                        </div>

                        <button type="submit" class="btn btn-primary">أضافه</button>
                        {!! Form::close() !!}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--  /Modal ِAdd -->

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
                        <h4 class="card-title mg-b-0">جدول المدن </h4> <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    @if (auth()->user()->can('city-create'))
                        <div class="d-flex justify-content-center mt-2 mb-2">
                            <button  class=" btn btn-primary" data-toggle="modal" data-target="#add">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                إضافة مدينه جديد</button>
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
                                            role="grid" aria-describedby="example_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="border-bottom-0 sorting_asc" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 137px;" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">#</th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">اسم المدينه </th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">تاريخ الانشاء</th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">تاريخ التعديل</th>
                                                    @if (auth()->user()->can('city-destroy') || auth()->user()->can('city-edit'))
                                                        <th class="no-after text-center" style="width: 500px;"> العمليات
                                                        </th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($records as $record)
                                                    <tr role="row" class="odd" id="form{{ $record->id }}">

                                                        <td tabindex="0" class="sorting_1">{{ $loop->iteration }}
                                                        </td>
                                                        <td data-route="{{ route('city.update', $record->id) }}">
                                                            {{ $record->name }}</td>
                                                        <td>{{ $record->created_at }}</td>
                                                        <td>{{ $record->updated_at }}</td>
                                                        @if (auth()->user()->can('city-destroy') || auth()->user()->can("city-edit"))
                                                            <td>
                                                                <div class="row text-center">
                                                                    @if (auth()->user()->can("city-edit"))

                                                                    <div class="col-6">
                                                                        <div class=" btn btn-success btn-sm edit"
                                                                            data-toggle="modal" data-target="#edit"
                                                                            data-id="{{ $record->id }}">
                                                                            <i class="fas fa-edit"></i>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    @if (auth()->user()->can("city-destroy"))
                                                                    <div class="col-6">
                                                                        <div data-token="{{ csrf_token() }}"
                                                                            data-id="{{ $record->id }}"
                                                                            data-route="{{ route('city.destroy', $record->id) }}"
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
                <strong>لا توجد مدن </strong>
            </div>
            @endif
        </div>
    </div>
    </div>
    </div>
    <!-- /row -->
    <div style="height: 500px;">
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
                    var $route = $(`#form${$id} td:nth-child(2)`).data("route");
                    $("#name").val(`${$name}`);
                    $("#formModel").attr("action", `${$route}`)
                });
            });

        })
    </script>
@endpush
