@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row w-100">
      <div class="col"><h1>Add mail</h1></div>
    </div>

    <div class="row">
        <form action="{{ route('mail.save') }}" method="post">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Please fix the following errors
                </div>
            @endif

            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Mail subject" value="{{ old('subject') }}">
                @if($errors->has('subject'))
                    <span class="help-block">{{ $errors->first('subject') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" placeholder="Dear X,">{{ old('body') }}</textarea>
                @if($errors->has('body'))
                    <span class="help-block">{{ $errors->first('body') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>  
@endsection