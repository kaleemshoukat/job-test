@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <form action="{{route('notification')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <h4>Send Notification</h4>
                </div>
                <div class="col-md-12">
                    <label for="">title</label>
                    <input type="text" class="form-control" name="title">
                    @error('title')
                    <label for="" class="text-danger">{{$message}}</label>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="">message</label>
                    <input type="text" class="form-control" name="message">
                    @error('message')
                    <label for="" class="text-danger">{{$message}}</label>
                    @enderror
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm" style="margin: 10px 0px;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
