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
                
                <form method="POST" action="/company/update/" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                        @endforeach
                    @endif
                    <input type="hidden" id="id" name="id"  value="{{ $result->id }}"><br>
                    <label>Name:</label><br>
                    <input type="text" id="name" name="name"  value="{{ $result->name }}"><br>
                    <label>Email:</label><br>
                    <input type="text" id="email" name="email" value="{{ $result->email }}"><br>
                    <label>Logo:</label><br>
                    <input type="file" id="logo" name="logo" value="{{ $result->logo }}"><br>
                    <label>Website:</label><br>
                    <input type="text" id="website" name="website" value="{{ $result->website }}"><br>

                    <input type="submit" value="Submit">
                  </form>                

            </div>
        </div>
    </div>
</div>
@endsection
