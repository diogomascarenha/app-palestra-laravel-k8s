@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" method="post" action="{{ route('home.saveFile') }}">
                        @csrf
                        <input type="file" name="arquivo" class="btn">
                        <input type="submit" value="upload" class="btn btn-primary">
                    </form>
                </div>
                <div class="card-body">
                    @forelse($files ?? [] as $file)
                        <div>
                            <form method="post" action="{{ route('home.deleteFile') }}" class="form-inline">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="file" value="{{$file}}">
                                <img class="img-thumbnail" src="{{\Storage::disk('gcs')->url($file)}}" width="200px">
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </div>
                    @empty
                        Nenhum arquivo encontrado
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
