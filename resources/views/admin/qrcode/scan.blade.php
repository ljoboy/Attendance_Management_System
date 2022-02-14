@extends('layouts.master-blank')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header align-content-center">{{ __('Enter your pin to confirm:') }}</div>

                    <div class="card-body">
                        <b>{{$employee->name}}</b>, {{ __("before proceeding, please make sure you've entered the right pin.") }}
                        <form class="form-horizontal m-t-30" method="POST" action="{{ route('qrcode.attendee') }}">
                            @csrf
                            <div class="form-group">
                                <label for="pin" class="col-form-label ">{{ __('Pin') }}</label>


                                <input id="pin" type="password" class="form-control @error('pin') is-invalid @enderror"
                                       name="pin" required autocomplete="current-password">
                                <input type="hidden" name="encrypted_emp_id" value="{{$encrypted_emp_id}}">

                                @error('pin')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Send
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
