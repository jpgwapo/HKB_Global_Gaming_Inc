@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employee') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <a href="/employee/create">Create an employee</a>
                <table class="table table-striped table-bordered nowrap" width="100%">
                    <thead>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date updated</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                        @foreach ($results as $res)
                            <tr>
                                <td>{!! $res->first_name !!}</td>
                                <td>{!! $res->last_name !!}</td>
                                <td>{!! $res->name !!}</td>
                                <td>{!! $res->email !!}</td>
                                <td>{!! $res->phone !!}</td>
                                <td>{!! $res->updated_at !!}</td>
                                <td><a href="/employee/edit/{{$res->id}}">Edit</a></td>
                                <td><a href="/employee/delete/{{$res->id}}">Delete</a></td>
                            </tr>
                        @endforeach
                </table>

                {{ $results->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
