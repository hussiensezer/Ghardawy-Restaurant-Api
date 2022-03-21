@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.home')
@endsection
@section('active')
    home
@endsection
@section('card_title')
    @lang('sidebar.home')
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('dashboard.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea class="form-control" name="body"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Notification</button>
    </form>
@endsection


@section('script')
@endsection
