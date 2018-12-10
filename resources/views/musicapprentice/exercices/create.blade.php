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


                        <form class="form-group" method="POST" action="/exercices"  enctype="multipart/form-data">
                            @csrf
                            <div class = "form-group">
                                <label for="">Nombre</label>
                                <input name="name" type="text" class="form-control">
                            </div>

                            <div class = "form-group">
                                <label for="">Resumen</label>
                                <textarea name="description" class="form-control"></textarea>
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
                                <textarea name="text" class="form-control"></textarea>
                            </div>

                            <div class “form-group”>
                                <label for="">Image</label>
                                <input name="image_file" type="file" accept=".gif,.jpg,.jpeg,.png">   
                            </div>


                            <div class “form-group”>
                                <label for="">Audio</label>
                                <input name="audio_file" type="file" accept=".mp3,.wav">   
                            </div>


                            <div class “form-group”>
                                <label for="">Video</label>
                                <input name="video_file" type="file" accept=".mp4,.mov, avi">   
                            </div>
                            
                            <div class = "form-group">
                                <label for="">Añadir a sesión</label>
                                <select name="session_id">
                                    <option value="-1">No añadir</option>
                                    {{ $request->user() }}
                                    @foreach($request->user()->sessions as $session)
                                          <option value="{{ $session->id }}">{{ $session->name }}</option>
                                    @endforeach                                    
                                </select>                         
                            </div>


                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
