@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Hola {{ $request->user()->name }}, login correcto!</div>




                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                </div>
                <div class="container"> 
                    <h2>Ejercicios</h2>
                    <div class="row ml-2 mb-3">
                        <a href="/exercices/create" class="btn btn-primary ">Crear nuevo</a>
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
                <div class="row"> <span class="m-auto"> {{ $exercices->links() }}</span></div>  

            </div>


            <div class="container"> 
                <h2>Sesiones</h2>
                <div class="row ml-2 mb-3">
                    <a href="/sessions/create" class="btn btn-primary ">Crear nueva</a>
                </div>
                <div class="row mb-3 justify-content-around"> 
                    @foreach($sessions as $session)

                    <div class=”col-sm-4”>
                        <div class="card" style="width: 18rem;">
                          <div class="card-body">
                            <h5 class="card-title">{{$session->name}}</h5>
                            <p class="card-text">{{ $session->description }}</p>
                            <form class="form-group" method="POST" action="/sessions/{{ $session->id }}"  enctype="multipart/form-data">
                                @method('DELETE')
                                @csrf

                                <button type="submit" class="btn btn-primary">Borrar</button>
                            </form>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
            <div class="row"> <span class="m-auto"> {{ $exercices->links() }}</span></div>  

        </div>

    </div>
</div>
</div>
@endsection
