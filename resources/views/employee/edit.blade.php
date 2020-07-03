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
                
                <form method="POST" action="/employee/update/">
                    @csrf
                    @method('PUT')

                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                        @endforeach
                    @endif

                    <input type="hidden" id="id" name="id"  value="{{ $result->id }}"><br>
                    <label>First name:</label><br>
                    <input type="text" id="first_name" name="first_name"  value="{{ $result->first_name }}"><br>
                    <label>Last name:</label><br>
                    <input type="text" id="last_name" name="last_name" value="{{ $result->last_name }}"><br>
                    <label>Company:</label><br>
{{ $result->company_id }}
                    <label>Company:</label><br>
                        <select name="company_id" id="company_id">
                            @foreach ($companies as $company)
                                  <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select><br>

                    <label>Email:</label><br>
                    <input type="text" id="email" name="email" value="{{ $result->email }}"><br>
                    <label>Phone:</label><br>

                    <input type="text" id="phone" name="phone" value="{{ $result->phone }}"><br>

                    <input type="submit" value="Submit">
                  </form>                

            </div>
        </div>
    </div>
</div>
@endsection
