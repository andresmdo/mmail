@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-hover table-hover-cursor" id="mails-list">
    <caption>Mails list</caption>
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Mail</th>
        <th scope="col">Created</th>
        <th scope="col">Updated</th>
      </tr>
    </thead>
    <tbody>
      @if (@empty($mails))
          <tr>
            <td colspan="3">List empty</td>
          </td>
      @endempty
      @foreach ($mails as $mail)
        <tr>
        <th scope="row" class="align-middle">{{ $loop->iteration + $indexfix }}</th>
          <td class="col-2 w-50">
            <button class="btn btn-link" data-toggle="collapse" data-target="#mail{{$mail->id}}" aria-expanded="false" aria-controls="mail{{$mail->id}}">
              {{ $mail->subject }}
            </button>
            <div id="mail{{$mail->id}}" class="collapse" aria-labelledby="heading{{$mail->id}}" class="w-50">
              {{-- {{ $mail->body }} --}}
              <div>
                {{-- <form action="{{ route('mails.destroy',$mail->id) }}" method="POST"> --}}
                  <a class="btn" href="{{ route('mail.view',$mail->id) }}">Show</a>
                  <a class="btn" href="{{ route('mail.edit',$mail->id) }}">Edit</a>

                  {{-- @csrf
                  @method('DELETE') --}}
                  {{-- <button type="submit" class="btn btn-secondary">Delete</button> --}}
                </form>
              </div>
            </div>
          </td>
          <td class="col-2 w-25">{{$mail->created_at}}</td>
          <td class="col-2 w-25">{{$mail->updated_at}}</td>
        </tr>
      @endforeach
      {{ $mails->links() }} Total: {{ $total }}
    </tbody>
  </table>
</div>
@endsection