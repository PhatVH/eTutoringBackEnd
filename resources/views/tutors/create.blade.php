@extends('layout')

@section('content')
<div class="outer-w3-agile mt-3">
    <h4 class="tittle-w3-agileits mb-4">Tutor Add Form</h4>
    <form action="/tutors" method="post">
        @csrf
        <div class="form-group">
          <label for="tutor_name">Name</label>
          <input type="text" name="tutor_name" id="tutor_name" class="form-control" placeholder="">
        </div>
        <div class="form-group">
          <label for="tutor_phone">Phone</label>
          <input type="text" name="tutor_phone" id="tutor_phone" class="form-control" placeholder="">
        </div>
        <div class="form-group">
          <label for="tutor_email">Email</label>
          <input type="text" name="tutor_email" id="tutor_email" class="form-control" placeholder="">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
