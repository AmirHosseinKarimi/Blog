@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Hi {{Auth::user()->name}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fas fa-file"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Posts</span>
              <span class="info-box-number">{{ $cards->posts->published }} <small>Published</small></span>
              <span class="text-danger">{{ $cards->posts->pending }} pending approval</span>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-comments"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Comments</span>
              <span class="info-box-number">{{ $cards->comments->approved }} <small>Approved</small></span>
              <span class="text-danger">{{ $cards->comments->pending }} pending approval</span>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Subscribers</span>
              <span class="info-box-number">{{ $cards->subscribers->all }}</span>
              <span class="text-success">{{ $cards->subscribers->new }} New</span>
            </div>
          </div>
        </div>
      </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop
