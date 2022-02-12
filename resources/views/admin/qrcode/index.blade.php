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

<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-qrcode-edit mr-2"></i>Generate for all</a>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

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
                        <td><a href="{{url('/') . $employee->qrcode_url}}">{{$employee->qrcode_url}}</a></td>
                        <td>{{$employee->created_at}}</td>
                        <td>

{{--                            url('qrcode.generate', $employee)--}}
                            <a href="{{$employee->name}}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-qrcode'></i> Generate QrCode </a>
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

@endsection
