@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Mail</h1>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">{{ $mail->subject }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $mail->created_at }}{{ !empty($mail->updated_at) ? ' - '.$mail->updated_at : '' }}</h6>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="card-link">Card link</a>
              <a href="#" class="card-link">Another link</a>
            </div>
          </div>
    </div>
</div>  
@endsection