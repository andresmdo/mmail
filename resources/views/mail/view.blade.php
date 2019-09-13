@extends('layouts.app')

@section('content')
<div class="container w-75">
  <div class="d-flex flex-column">
    <div class="flex-row">
      <h1>Mail full view</h1>
    </div>
    <div class="flex-row">
      <div class="card">
        <div class="card-header">
          <label>Subject: </label>
          <h3 class="card-title">{{ $mail->subject }}</h3>
        </div>
        <div class="card-body">
          <label>Body:</label>
          <div id='text-viewrr'>
          </div>
          {{-- <p class="card-text">{{ $mail->body }}</p> --}}
          <p><small>Created: {{ $mail->created_at }}{{ !empty($mail->updated_at) ? ' - Updated '.$mail->updated_at : '' }}</small></p>
          <a href="{{ route('mail.edit', $mail->id) }}" class="card-link">Edit</a>
          <a href="{{ URL::previous() }}" class="card-link">Back</a>
        </div>
      </div>
    </div>
  </div>  
</div>
<script>
  
</script>
@endsection

@section('js')
  const body_rr = '{!! $mail->body !!}';
@endsection