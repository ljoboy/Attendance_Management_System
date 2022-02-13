@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">QrCode</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">QrCode</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Employees List</a></li>

        </ol>
    </div>
@endsection

@section('content')
    @include('includes.flash')

    <button onclick="generateQrcodes();" class="btn btn-primary btn-sm btn-flat"><i
            class="mdi mdi-qrcode-scan mr-2"></i>Generate for all
    </button>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                        <tr>
                            <th data-priority="1">Employee ID</th>
                            <th data-priority="2">Name</th>
                            <th data-priority="3">position</th>
                            <th data-priority="4">Email</th>
                            <th data-priority="5">QrCode</th>
                            <th data-priority="6">Member Since</th>
                            <th data-priority="7">Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $employees as $employee)

                            <tr>
                                <td>{{$employee->id}}</td>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->position}}</td>
                                <td>{{$employee->email}}</td>
                                <td>
                                    @if($employee->qrcode_url)
                                        <img src="{{URL::asset($employee->qrcode_url)}}"
                                             alt="{{$employee->name}}'s QrCode"/>
                                    @endif
                                </td>
                                <td>{{$employee->created_at}}</td>
                                <td>
                                    @if(!$employee->qrcode_url)
                                        <a href="{{route('qrcode.generate.one', [$employee])}}"
                                           class="btn btn-success btn-sm edit btn-flat">
                                            <i class='fa fa-qrcode'></i> Generate QrCode
                                        </a>
                                    @else
                                        <a href="{{route('qrcode.generate.one', $employee->id)}}"
                                           class="btn btn-warning btn-sm edit btn-flat">
                                            <i class='mdi mdi-qrcode-edit'></i> Regenerate QrCode
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div> <!-- end col -->
    </div> <!-- end row -->

@endsection


@section('script')
    <!-- Responsive-table-->
    <script>
        function generateQrcodes() {
            Swal.fire({
                title: "Generate?",
                icon: 'question',
                text: "Please ensure and then confirm!",
                showCancelButton: !0,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, generate it!",
                cancelButtonText: "No, cancel!",
                allowEscapeKey: false,
                allowOutsideClick: () => !Swal.isLoading(),
                reverseButtons: !0,
                preConfirm: function () {
                    return new Promise(function () {
                        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            type: 'POST',
                            url: "{{url('/qrcode')}}",
                            data: {_token: CSRF_TOKEN},
                            dataType: 'JSON',
                            success: function (results) {
                                if (results.success === true) {
                                    Swal.fire("Done!", results.message, "success");
                                    // refresh page after 2 seconds
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire("Error!", results.message, "error");
                                }
                            },
                            error: function (results) {
                                Swal.fire("Error!", results.messages, "error");
                                console.log(results);
                            }
                        });
                    });
                },
            }).then(function (results) {
                console.log(results);
            });
        }
    </script>
@endsection
