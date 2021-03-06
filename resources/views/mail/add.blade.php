@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col"><h1>Add mail</h1></div>
      <div class="pull-right">
        <a href="{{ URL::previous() }}" class="card-link">Back</a>
      </div>
    </div>

    <div class="row w-100">
      <div class="col">
        <form action="{{ route('mail.save') }}" method="post">
            @csrf
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
                @if($errors->has('subject'))
                    <span id="subjectHelpBlock" class="form-text text-danger">{{ $errors->first('subject') }}</span>
                @endif
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Mail subject" value="{{ old('subject') }}" aria-describedby="subjectHelpBlock">
            </div>
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                <label for="body">Body</label>
                @if($errors->has('body'))
                    <span id="bodyHelpBlock" class="form-text text-danger">{{ $errors->first('body') }}</span>
                @endif
                <textarea class="form-control d-none" id="body" name="body" placeholder="Dear X," aria-describedby="bodyHelpBlock">{{ old('body') }}</textarea>
            </div>
            <div class="row">
              <div class="col" id="text-editrr"></div>
            </div>      
            <div class="form-group">
                <button type="submit" class="btn btn-default">Submit</button>
                <a href="{{ URL::previous() }}" class="card-link">Back</a>
            </div>    
        </form>
      </div>
    </div>
</div>  
@endsection

@section('js')
const body_rr = '';
@endsection