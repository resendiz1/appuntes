@extends('plantilla')
@section('contenido')
    

<div class="container mt-5">
    <h3 class="text-center font-weight-bold text-white">Editar tema principal</h3>

    <div class="row card p-3">

        <form method="POST" action="{{route('apunte.update', $apunte)}}" enctype="multipart/form-data"  >
            @csrf @method('PATCH')
              <div class="md-form">
                <label for="titulo">Titulo de apunte</label>
              <input type="text" name="titulo" id="titulo" class="form-control" value="{{$apunte->titulo}}" required>
              </div>
              <div class="md-form">
                <label for="apunte">Explicación del apunte</label>
              <textarea name="explicacion" id="apunte" class="form-control md-textarea"   cols="30" rows="10">{{$apunte->explicacion}}</textarea>
              </div>
        
              <div class="md-form">
                @if ($errors->any())
                <div class="alert alert-danger bora">{{$errors->first('imagen')}}</div>
                
            @endif
                <input type="file" name="imagen" class="form-control" id="imagen">
              </div>
              
              <div class="md-form justify-content-center text-center">
              <img src="{{Storage::url($apunte->imagen)}}" class="img-fluid" alt="">
              </div>
        
          </div>
          <div class="modal-footer justify-content-center">
          <a href="{{route('inicio')}}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-success">Guardar cambios</button>
          </div>
        </form>
    </div>
</div>


@endsection