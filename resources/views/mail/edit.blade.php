@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col"><h1>Edit mail</h1></div>
    </div>

    <div class="row w-100">
      <div class="col">
        <form action="{{ route('mail.update', $mail) }}" method="post">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Please fix the following errors
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li> - {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Mail subject" 
                  value="{{ (!empty(old('subject'))) ? old('subject') : $mail->subject }}" 
                  aria-describedby="subjectHelpBlock">
                @if($errors->has('subject'))
                    <span id="subjectHelpBlock" class="form-text text-danger">{{ $errors->first('subject') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" placeholder="Dear X," aria-describedby="bodyHelpBlock">
                  {{ (!empty(old('body'))) ? old('body') : $mail->body }}
                </textarea>
                @if($errors->has('body'))
                    <span id="bodyHelpBlock" class="form-text text-danger">{{ $errors->first('body') }}</span>
                @endif
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-default">Submit</button>
              <a href="{{ URL::previous() }}" class="card-link">Back</a>
            </div>
        </form>
      </div>  
    </div>

    <div class="row">
      <div class="col" id="DISABLED-text-editrr"></div>
    </div>          
      
</div>  
@endsection