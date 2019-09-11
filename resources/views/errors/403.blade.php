@extends('layouts.app')

@section('content')
<div class="container">
<div class="alert alert-secondary w-50 mx-auto" role="alert">
    <h4 class="alert-heading center text-center">403 | {{ $exception->getMessage()}}</h4>
    <hr>
    <p class="mb-0">Looks like this belongs to someone else. <a href="{{ URL::previous() }}" class="card-link">Go back.</a></p>
</div>
</div>
@endsection