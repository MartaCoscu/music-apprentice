@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Exercices</div>

                <div class="container"> 
                    <div class="row mb-3 ml-1 mt-2">
                        <a href="/exercices/create" class="btn btn-primary">Crear nuevo</a>
                    </div>
                    <div class="row mb-3 justify-content-around"> 
                        @foreach($exercices as $exercice)

                        <div class=”col-sm-4”>
                            <div class="card" style="width: 18rem;">
                              <div class="card-body">
                                <h5 class="card-title">{{$exercice->name}}</h5>
                                <p class="card-text">{{ $exercice->description }}</p>
                                <a href="/exercices/{{$exercice->id }}" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
