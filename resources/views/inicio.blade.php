@extends('plantilla')
@section('contenido')
    


    <div class="container">
        <div class="row justify-content-center">
          <img src="img/image1.png" class="img-fluid" width="200px" alt="">
        </div>
      </div>
<div class="row">
  <div class="col-12">
    @if ($errors->any())
  <div class="alert alert-danger bora
  ">{{$errors->first('imagen')}}</div>
        
    @endif
  </div>
</div>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark primary-color ">
    
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <!-- Collapsible content -->
      <div class="collapse navbar-collapse " id="basicExampleNav">
        <ul class="navbar-nav m-auto">
          <li class="nav-item ">
            <a class="nav-link"  data-toggle="modal" data-target="#fullHeightModalRight"><i class="fas fa-plus-circle mr-1 fa-1x"></i>NUEVO APUNTE
    
            </a>
          </li>
        </ul>
      </div>
      <!-- Collapsible content -->
    </nav>
    <!--/.Navbar-->
    
    <div class="container mt-4">
      @if (session('mensaje'))
      <div class="row">
        <div class="alert alert-success text-center btn-block bor h3 animated heartBeat">{{session('mensaje')}}</div>
      </div>  
      @endif
      @if (session('eliminado'))
      <div class="row">
        <div class="alert alert-danger text-center btn-block bora h3 animated heartBeat">{{session('eliminado')}}</div>
      </div>  
      @endif
      <div class="row d-flex justify-content-between">
    
@forelse ($apunte as $apunteItem)
<div class="col-lg-4 col-md-6 col-sm-12 card p-3 mt-4 animated bounce">
  <h3 class="text-center">{{$apunteItem->titulo}}</h3>
<p>{{$apunteItem->explicacion}}</p>
<img src="{{Storage::url($apunteItem->imagen)}}" class="img-fluid" alt="" data-toggle="modal" data-target="#i{{$apunteItem->id}}">
<div class="card-footer d-flex justify-content-between mt-2">
  <a href="{{route('apunte.show', $apunteItem)}}" class="btn btn-info btn-block">Ver</a>
</div>
<small class="text-center">{{$apunteItem->created_at->diffForHumans()}}</small>
<div class="row justify-content-left p-3">
  <a href="{{route('apunte.edit', $apunteItem)}}"><i class="fa fa-edit mr-1"></i>Modificar</a>
<a  class="text-danger mx-3" href="" data-toggle="modal" data-target="#d{{$apunteItem->id}}"> <i class="fa fa-trash-alt mr-1"></i>Eliminar</a>
</div>
</div>



<!-- Central Modal Small -->
<div class="modal fade" id="i{{$apunteItem->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <img src="{{Storage::url($apunteItem->imagen)}}" class="img-fluid" alt="">
    </div>
  </div>
</div>
<!-- Central Modal Small -->

    {{-- modal de eliminado del apunte --}}



<!-- Modal -->
<div class="modal fade" id="d{{$apunteItem->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
      <h5 class="modal-title " id="exampleModalLabel">¿Deseas eliminar el apunte de: <span class="font-italic text-lowercase">{{$apunteItem->titulo}}</span> ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <form action="{{route('apunte.destroy', $apunteItem)}}" method="POST">
          @csrf @method('DELETE')
        {{-- <input type="hidden" value="{{$apunteItem->id}}"> --}}
        <button type="submit" class="btn btn-danger"> <i class="fa fa-trash-alt mr-3"></i> Eliminar</button>
      </form>
      </div>
    </div>
  </div>
</div>






@empty

<li class="text-white font-weight-bold">No hay nada aqui</li>
    
@endforelse
    
 <div class="container mt-5 justify-content-center text-center">
      
{{$apunte->links()}}

   </div> 
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- Full Height Modal Right -->
    <div class="modal fade left" id="fullHeightModalRight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
    
      <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
      <div class="modal-dialog modal-full-height modal-left" role="document">
        <div class="modal-content">
          <div class="modal-header blue-gradient  text-white">
            
            <h4 class="font-weight-bold w-100" id="myModalLabel">Nuevo tema</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body justify-content-center">
          <form method="POST" action="{{route('apunte.store')}}" enctype="multipart/form-data"  >
            @csrf
              <div class="md-form">
                <label for="titulo">Titulo de apunte</label>
                  <input type="text" name="titulo" id="titulo" class="form-control" required>
              </div>
              <div class="md-form">
                <label for="apunte">Explicación del apunte</label>
                <textarea name="explicacion" id="apunte" class="form-control md-textarea"   cols="30" rows="10"></textarea>
              </div>
              <div class="md-form">
                <label for="apunte">Código de inserción de youtube</label>
                <textarea  name="link" class="form-control md-textarea"> </textarea>
              </div>
              <div class="md-form">
                <input type="file" name="imagen" class="form-control" id="imagen">
              </div>
            
    
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    
      </div>
    </div>
    














    @endsection