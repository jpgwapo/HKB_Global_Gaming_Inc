@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Company') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <a href="/company/create">Create company</a>
                <table class="table table-striped table-bordered nowrap" width="100%">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Websiteo</th>
                        <th>Date updated</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                        @foreach ($results as $res)
                            <tr>
                                <td>{!! $res->name !!}</td>
                                <td>{!! $res->email !!}</td>
                                <td><img src="{{ URL::to('/images/'.$res->logo) }}"></td>
                                <td>{!! $res->website !!}</td>
                                <td>{!! $res->updated_at !!}</td>
                                <td><a href="/company/edit/{{$res->id}}">Edit</a></td>
                                <td><a href="/company/delete/{{$res->id}}">Delete</a></td>
                            </tr>
                        @endforeach
                </table>

                {{ $results->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
