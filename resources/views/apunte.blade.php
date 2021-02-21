@extends('plantilla')

@section('contenido')

<div class="container">
  <div class="row">
  </div>
    <div class="row mt-5">
        <div class="col-12 card bg-success p-3 animated bounce">
          <a href="{{route('inicio')}}" class="text-white font-weight-bold btn-sm"> Regresar </a>
            <h2 class="text-center font-weight-bold  text-white">{{$apunte->titulo}}</h2>
        </div>
    </div>

 

  @if (session('mensaje'))
  <div class="row">
    <div class="alert alert-success text-center btn-block bor h3 animated heartBeat">{{session('mensaje')}}</div>
  </div>  
  
      
  @endif

<div class="row shadow bg-white p-3 mt-2">
    <div class="col-lg-6 col-md-12  mt-2 animated jackInTheBox">

        <h2 class="text-center">EXPLICACIÓN</h2>
        <p class="text-justify">{{$apunte->explicacion}} </p>
    </div>
    <div class="col-lg-6 col-md-12  align-middle animated heartBeat ">
      <div class="col-12 d-flex justify-content-end">
        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"></i> Agregar pasos a este tutorial
          </button>
          @if ($errors->any())

          
        <div class="alert alert-danger bora alert-sm">{{$errors->first('imagen')}}</div>
          
            @endif
          
    </div>
    <img src="{{Storage::url($apunte->imagen)}}" class="img-fluid rounded " alt="" data-toggle="modal" data-target="#a{{$apunte->id}}">
    </div>
</div>





<!-- Central Modal Small -->
<div class="modal fade" id="a{{$apunte->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <img src="{{Storage::url($apunte->imagen)}}" class="img-fluid" alt="">

    </div>
  </div>
</div>
<!-- Central Modal Small -->


















<div class="row card mt-3 p-4">
  <h3 class="text-center font-weight-bold">Video de muestra</h3>
  <div class="col-lg-4 col-md-6 col-lg-12 p-4 text-center">
  {!!$apunte->link!!}
  </div>
    <h2 class=" m-2 font-weight-bold"> <li> Pasos para completar este tutorial</li></h2>
    <div class="accordion" id="accordionExample">

@forelse ($pasos as $pasosItem)

<div class="card rollIn animated">
  <div class="card-header btn-primary p-0" id="headingOne">
    <h2 class="mb-0">
      <button class="btn btn-link btn-block text-left text-white font-weight-bold" type="button" data-toggle="collapse" data-target="#c{{$pasosItem->id}}" aria-expanded="true" aria-controls="collapseOne">
      Paso :  <small> {{$pasosItem->titulo}}</small>
      </button>
    </h2>
  </div>

  <div id="c{{$pasosItem->id}}" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
    <div class="card-body">
        <h3>{{$pasosItem->titulo}}</h3>
     <p> {{$pasosItem->descripcion}}</p>

    

         <div class="col mt-5 justify-content-center text-center">
         <img src="{{Storage::url($pasosItem->imagen)}}" class="img-fluid  w-50" alt="">

        </div>
    </div>
  </div>
</div>
<br>

@empty
  <li>No hay nada aqui</li>
@endforelse










        
      </div>



      <br>
      <br>
      <br>
      <br>
      <br><br>
      <br>
      <br>
      <br>
      <br>


</div>
<div class="row mt-5 shadow p-4 bg-white">
  <div class="col-12 shadow">
    <form action="{{route('comment.store')}}" method="POST">
      @csrf
        <div class="md-form">
        <input type="hidden" name="apunte_id" value="{{$apunte->id}}">
          <i class="fas fa-comment-alt prefix"></i>
          <textarea id="form10" name="comentario" class="md-textarea form-control" rows="3" required></textarea>
          <label for="form10">Comentar</label>
        </div>
        <div class="md-form">
          <button class="btn btn-success btn-sm" type="submit"> <i class="fas fa-comment mr-2"></i> Comentar</button>
        </div>
      </form>
    </div>
@forelse ($comentarios as $comentariosItem)
<div class="col-lg-4 col-md-6 col-sm-12 card p-4 text-center mt-5">
<h2 class="font-weight-bold">{{$comentariosItem->nombre}}</h2>
  <p>{{$comentariosItem->comentario}}</p>
<small class="badge badge-secondary badge-sm">{{$comentariosItem->created_at->diffForHumans()}}</small>
</div>
@empty
    
@endforelse
</div>






  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
  
    <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
    <div class="modal-dialog modal-dialog-centered" role="document">
  
  
      <div class="modal-content">
        <div class="modal-header bg-gradient">
          <h5 class="modal-title" id="exampleModalLongTitle">Agregar paso </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('pasos.store')}}" enctype="multipart/form-data">
          @csrf
            <div class="md-form">
              <i class="fas fa-newspaper prefix"></i>
              <label for="titulo">Titulo</label>
              <input type="text" class="form-control" id="titulo" name="titulo">
            </div>
            <div class="md-form">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea id="form10" name="descripcion" class="md-textarea form-control" rows="3"></textarea>
            <input type="hidden" name="apunte_id" value="{{$apunte->id}}">
              <label for="form10">Icon Prefix</label>
            </div>
            <div class="md-form">
              <i class="fas fa-image prefix"></i>
              
              <input type="file" class="form-control" id="imagen" name="imagen" required>
            </div>
         
        </div>
        <div class="modal-footer">
          
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</div>
    
@endsection