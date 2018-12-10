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


                        <form class="form-group" method="POST" action="/exercices/{{ $exercice->id }}"  enctype="multipart/form-data">
                            @method('PUT')

                            @csrf

                            <div class = "form-group">
                                <label for="">Nombre</label>
                                <input name="name" type="text" value={{ $exercice->name }} class="form-control">
                            </div>

                            <div class = "form-group">
                                <label for="">Resumen</label>
                                <textarea name="description" class="form-control">{{ $exercice->description }} 
                                </textarea>
                            </div>


                            <div class = "form-group">
                                <label for="">Categoria</label>
                                <select name="categoria_id">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach                                    
                                </select>                         
                            </div>

                            <div class = "form-group">
                                <label for="">Tags. Separa con comas. </label>
                                <input name="tags" type="text" class="form-control">
                            </div>

                            <div class = "form-group">
                                <label for="">Ejercicio</label>
                                <textarea name="text" class="form-control">{{ $exercice->text }}</textarea>
                            </div>






                            @if(file_exists(public_path("/images/".$exercice->image))  and (empty($exercice->image) == false ))
                            <img class="card-img-top" src="../../images/{{$exercice->image}}" alt="imagen del ejercicio">
                            @else
                            <span>No se añadió ninguna imagen</span>
                            @endif
                            <div class “form-group”>
                                <label for="">Image</label>
                                <input name="image_file" type="file" accept=".gif,.jpg,.jpeg,.png">   
                            </div>

                            @if(file_exists(public_path("/audios/".$exercice->audio))  and (empty($exercice->audio) == false ))
                            <audio controls>
                                ç  <source src="../../audios/{{$exercice->audio}}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>                         @else
                                <span>No se añadió ninguna imagen</span>
                                @endif
                                <div class “form-group”>
                                    <label for="">Audio</label>
                                    <input name="audio_file" type="file" accept=".mp3">   
                                </div>


                                @if(file_exists(public_path("/videos/".$exercice->video))  and (empty($exercice->video) == false ))
                                <video width="320" height="240" controls>
                                  <source src="../../videos/{{$exercice->video}}"; type="video/mp4">
                                    Your browser does not support the video tag.
                                </video> 
                                @else
                                <span>No se añadió ningún video</span>
                                @endif
                                <div class “form-group”>
                                    <label for="">Video</label>
                                    <input name="video_file" type="file" accept=".mp4" value="../../videos/{{$exercice->video}}">   
                                </div>

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

                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>

                                <form class="form-group" method="POST" action="/exercices/{{ $exercice->id }}"  enctype="multipart/form-data">
                                    @method('DELETE')
                                       @csrf

                                    <button type="submit" class="btn btn-primary">Borrar</button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endsection
