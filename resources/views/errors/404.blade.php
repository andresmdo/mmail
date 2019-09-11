@extends('layouts.app')

@section('content')
<div class="container">
<div class="alert alert-secondary w-50 mx-auto" role="alert">
    <h4 class="alert-heading center text-center">404 | {{ $exception->getMessage() ? $exception->getMessage() : 'Not Found'}}</h4>
    <hr>
    <p class="mb-0">The element you are looking for is not here. <a href="{{ URL::previous() }}" class="card-link">Go back.</a></p>
</div>
</div>
@endsection