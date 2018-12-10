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


                        <form class="form-group" method="POST" action="/sessions"  enctype="multipart/form-data">
                            @csrf
     
                            <div class = "form-group">
                                <label for="">Nombre</label>
                                <input name="name" type="text" class="form-control">
                            </div>

                            <div class = "form-group">
                                <label for="">Description</label>
                                <input name="description" type="text" class="form-control">
                            </div>



                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
