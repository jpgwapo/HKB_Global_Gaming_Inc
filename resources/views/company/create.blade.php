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

                    <form method="POST" action="/company/store" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                        @endforeach
                    @endif
                    <label>Name:</label><br>
                    <input type="text" id="name" name="name"  value="{{ old('name') }}"><br>
                    <label>Email:</label><br>
                    <input type="text" id="email" name="email" value="{{ old('email') }}"><br>
                    <label>Logo:</label><br>
                    <input type="file" id="logo" name="logo" value="{{ old('logo') }}"><br>
                    <label>Website:</label><br>
                    <input type="text" id="website" name="website" value="{{ old('website') }}"><br>
                    <input type="submit" value="Submit">
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
