@extends('layout')

@section('content')
    <!-- table1 -->
    <div class="outer-w3-agile mt-3">
        <h4 class="tittle-w3-agileits mb-4">Basic Table</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tutors as $tutor)
                    <th scope="row">{{ $tutor->id }}</th>
                    <td>{{ $tutor->tutor_name }}</td>
                    <td>{{ $tutor->tutor_email }}</td>
                    <td>{{ $tutor->tutor_phone }}</td>
                @endforeach
            </tbody>
        </table>
    </div>
    <!--// table1 -->
@endsection
