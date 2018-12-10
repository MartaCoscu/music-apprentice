@extends('layouts.app')

@section('content')



                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                </div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $exercice->name }}. Categoria: {{ $exercice->category->name }}</div>

                <div class="container"> 
                    <div>{{ $exercice->text }}</div>
                </div>
            </div>


            <div class="card">

                <div class="card-header">Video.</div>

                <div class="container"> 


                 @if(file_exists(public_path("/videos/".$exercice->video)) && (empty($exercice->video) == false ))
                 <video width="320" height="240" controls>
                  <source src="../videos/{{$exercice->video}}"; type="video/mp4">
                    Your browser does not support the video tag.
                </video> 
                @else
                <span>No se añadió ningún video</span>
                @endif
            </div>



            <div class="card">

                <div class="card-header">Image</div>

                <div class="container"> 
                 @if(file_exists(public_path("/images/".$exercice->image))  and (empty($exercice->image) == false ))
                    <img class="card-img-top" src="../images/{{$exercice->image}}" alt="imagen del ejercicio">
                    @else
                    <span>No se añadió ninguna imagen</span>
                    @endif
                </div>
            </div>



            <div class="card">

                <div class="card-header">Audio</div>

                <div class="container"> 
                 @if(file_exists(public_path("/audios/".$exercice->audio))  and (empty($exercice->audio) == false ))
                    <audio controls>
                        ç  <source src="../audios/{{$exercice->audio}}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>                         @else
                        <span>No se añadió ninguna imagen</span>
                        @endif
                    </div>
                </div>


            </div>


          <!--  <div class="card">

                <div class="card-header">Añadir a sesión</div>



                <div class="container"> 
                    <div class = "form-group">
                        <label for="">Añadir a sesión</label>
                        <select name="session_id">

                            <option value="-1"
                            @if (is_null($exercice->sessions))
                            selected

                            @endif
                            >No añadir</option>

                            @foreach($request->user()->sessions as $session)

                            <option value={{ $session->id }}
                            @if (musicapprentice\Exercice::ContainsSession($exercice, $session))
                            selected

                            @endif
                            >{{ $session->name }}</option>

                            @endforeach                                    
                        </select>                         
                    </div>

                </div>-->
            </div>
            <a href="/exercices/{{$exercice->id }}/edit" class="btn btn-primary">Editar</a>


        </div>
        @endsection
