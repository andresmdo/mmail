@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
          {{ session('status') }}
      </div>
    @endif
    <div class="jumbotron">
        <h1 class="display-4">Hi {{ Auth::user()->name }}!</h1>
        @if ($amount > 0) 
          <p class="lead">You have {{ $amount }} of mails created by now!</p>
          <hr class="my-4">
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="{{ route('mail.add') }}" role="button">Create</a>
            <a class="btn btn-primary btn-lg" href="{{ route('mail.list') }}" role="button">List</a>
          </p>
        @else
          <p class="lead">You don't have any campaign created, start now!</p>
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="{{ route('mail.add') }}" role="button">Create new!</a>
          </p>
        @endif
      </div>
</div>
@endsection
