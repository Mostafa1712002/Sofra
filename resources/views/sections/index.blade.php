@extends('layouts.master')

@push('css')
    <style>
        .jconfirm-closeIcon {
            visibility: hidden;
        }

    </style>
@endpush

@section('title')
    أقسام الفواتير
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الأعدادت</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة
                    اقسام الفواتير</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- Modal Edit -->
    <div class="modal fade" id="edit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">
                        تعديل بياتات القسم
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'formModel', 'method' => 'put']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'أسم القسم') !!}
                        {!! Form::text('name', null, ['name' => 'name', 'id' => 'name', 'class' => 'form-control', 'placeholder' => 'تعديل أسم القسم']) !!}

                    </div>

                    <div class="form-group">
                        {!! Form::label('description', ' وصف القسم', ['class' => 'bold']) !!}
                        {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'تعديل وصف القسم']) !!}
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
    <!-- / Modal Edit -->

    <!-- Modal ِAdd -->
    <div class="modal fade" id="add" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">
                        إضافة بياتات القسم
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'formModel', 'route' => 'section.create', 'method' => 'get']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'أسم القسم') !!}
                        {!! Form::text('name', null, ['name' => 'name', 'id' => 'name', 'class' => 'form-control', 'placeholder' => ' أسم القسم']) !!}

                    </div>

                    <div class="form-group">
                        {!! Form::label('description', ' وصف القسم', ['class' => 'bold']) !!}
                        {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control', 'placeholder' => ' وصف القسم']) !!}
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
                        <h4 class="card-title mg-b-0">جدول أقسام الفواتير </h4> <i
                            class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        <button class=" btn btn-info" data-toggle="modal" data-target="#add">إضافة قسم جديد</button>
                    </div>
                </div>
                @if (count($records))
                    <div class="card-body">
                        <div>
                            <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example"
                                            class="table key-buttons text-md-nowrap dataTable no-footer dtr-inline"
                                            role="grid" aria-describedby="example_info" style="width: 1162px;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="border-bottom-0 sorting_asc" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 137px;" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">#</th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">اسم القسم </th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;"> وصف القسم </th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;"> منشئ القسم</th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">تاريخ الانشاء</th>
                                                    <th class="border-bottom-0 sorting" tabindex="0" rowspan="1" colspan="1"
                                                        style="width: 500px;">تاريخ التعديل</th>
                                                    <th style="width: 500px;"> العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($records as $record)
                                                    <tr role="row" class="odd" id="form{{ $record->id }}">

                                                        <td tabindex="0" class="sorting_1">{{ $loop->iteration }}
                                                        </td>
                                                        <td data-route="{{ route('section.update', $record->id) }}">
                                                            {{ $record->name }}</td>
                                                        <td>
                                                            <div class="btn btn-info btn-sm showDesc"
                                                                data-desc="{{ $record->description }}">
                                                                عرض الوصف
                                                            </div>
                                                        </td>
                                                        <td>{{ $record->created_by }}</td>
                                                        <td>{{ $record->created_at }}</td>
                                                        <td>{{ $record->updated_at }}</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=" btn btn-success btn-sm edit"
                                                                        data-toggle="modal" data-target="#edit"
                                                                        data-id="{{ $record->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div data-token="{{ csrf_token() }}"
                                                                        data-id="{{ $record->id }}"
                                                                        data-route="{{ route('section.destroy', $record->id) }}"
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
                <strong>لا توجد فواتير بعد </strong>
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
