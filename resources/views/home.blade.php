@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Welcome to Dating Web App') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ asset('/images/'.Auth::user()->image)  }}" alt="" height="300"
                                     width="300">
                                <form method="POST" action="{{ route('upload-profile') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="file" accept="image/jpeg,png,jpg"
                                                   class="form-control" name="profile">
                                            @if ($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <strong class="text-danger">
                                                        {{ $error }}
                                                    </strong>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">

                                                {{ __('Upload profile') }}

                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button class="btn btn-success">
                                            <a class="text-white" style="text-decoration: none;"
                                               href="{{ route('all-user-view') }}">
                                                {{ __('View all users') }}
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--    <user-list></user-list>--}}
    </div>
@endsection
