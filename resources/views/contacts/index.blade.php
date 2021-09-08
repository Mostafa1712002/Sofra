@extends('layouts.master')

@section('title')
    الرسائل المستلمه-سفره
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرسائل المستلمه</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة الرسائل المستلمه</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- Fillter Model -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">عملية فلترة لرسائل المستلمه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'get', 'route' => 'contact.index']) !!}
                    <div class="form-group">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'فلترة بالاسم  ']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('message', null, ['class' => 'form-control', 'placeholder' => 'فلترة بمحتوي  الرساله المستلمه']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'فلترة بمحتوي  برقم الجول']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('date', 'فتلرة التاريخ') !!}
                        {!! Form::date('date', null, ['id' => 'date_from', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('type', 'نوع الرساله') !!}
                        <select class="form-control" name="type" id="type">
                            <option disabled selected> اختر نوع الرساله </option>
                            <option value="complaint">شكوي</option>
                            <option value="query">استعلام</option>
                            <option value="suggest">اقترح</option>
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

    <!--/ Fillter Modal -->


    <div class="row ">
        <!--div-->
        <div class="col-xl-12">
            <div class=" @if (count($records)) card @endif mg-b-20">
                <div class="@if (count($records)) card-header @endif pb-0">
                    <div class="d-flex justify-content-center">
                        <h4 class="card-title mg-b-0">جدول الرسائل المستلمه </h4> <i
                            class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        <p type="button" class="btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            فلترة الرسائل المستلمه
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
                                                    <th class="border-bottom-0 text-center  sorting_asc" tabindex="0"
                                                        rowspan="1" colspan="1" style="width: 137px;" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">#</th>
                                                    <th class="border-bottom-0 text-center sorting" tabindex="0" rowspan="1"
                                                        colspan="1" style="width: 500px;">اسم المرسل </th>
                                                    <th class=" no-after border-bottom-0 text-center sorting" tabindex="0"
                                                        rowspan="1" colspan="1" style="width: 500px;"> الرساله </th>
                                                    <th class=" border-bottom-0 text-center sorting" tabindex="0"
                                                        rowspan="1" colspan="1" style="width: 500px;"> رقم الجوال </th>
                                                    <th class="border-bottom-0  text-center sorting" tabindex="0"
                                                        rowspan="1" colspan="1" style="width: 500px;"> نوع الرساله </th>
                                                    <th class="border-bottom-0   text-center sorting" tabindex="0"
                                                        rowspan="1" colspan="1" style="width: 500px;">  التاريخ </th>

                                                    @if (auth()->user()->can("contact-destroy"))
                                                    <th class=" no-after border-bottom-0 text-center sorting" tabindex="0"
                                                        rowspan="1" colspan="1" style="width: 500px;"> حذف</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($records as $record)
                                                    <tr role="row" class="odd" id="form{{ $record->id }}">

                                                        <td tabindex="0" class="sorting_1 text-center ">
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td class="text-center">{{ $record->full_name }}</td>
                                                        <td class="text-center" style="cursor: pointer"
                                                            data-desc="{{ $record->message }}">
                                                            <b class="btn-sm btn-info showDesc">الرساله</b>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $record->phone }}
                                                        </td>
                                                        <td class="text-center tx-11" style="color: white">
                                                            @php    $word = $record->type;   @endphp
                                                            @if ($word == 'query')

                                                                <b class=" p-1 bg-info">استعلام</b>
                                                            @elseif ($word == 'complaint')
                                                                <b class=" p-1 bg-danger">شكوي</b>
                                                            @else
                                                                <b class=" p-1 bg-success">اقتراح</b>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $record->created_at->format('Y-m-d') }}</td>
                                                            @if (auth()->user()->can("contact-destroy"))

                                                            <td class="text-center">
                                                                <div data-token="{{ csrf_token() }}"
                                                                    data-id="{{ $record->id }}"
                                                                    data-route="{{ route('contact.destroy', $record->id) }}"
                                                                    class="btn btn-danger btn-sm" id="destroy">
                                                                    <i class="fas fa-trash "></i>
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
                <strong>لا توجد رسائل مستلمه </strong>
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
            // Show Descripation
            $(".showDesc").each(function() {

                $(this).click(function() {
                    var $desc = $(this).parent().data("desc");
                    $.dialog({
                        title: 'محتوي الرساله',
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
