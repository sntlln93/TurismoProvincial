@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title">
        <h2>Experiencias</h2>
    </div>
    
    <div class="row">
        <div class="search">
            <input id="activity-search" type="text" class="form-control" placeholder="Buscar" aria-label="Buscar">
            <button><i class="icon-search"></i></button> 
        </div>
        <div class="add-other">
            <button id="open"> 
                <i class="icon-plus"></i> Nueva experiencia
            </button>
        </div>
    </div>


    <div id="miModal" class="modal add">
        <div class="flex" id="flex">
            <div class="container-modal">
                <div class="modal-header flex">
                    <h2>Nueva actividad</h2>
                    <span class="close" id="close">&times;</span>
                    
                </div>
                <div class="modal-body">
                    <form action="{{ url('panel-de-administracion/activities') }}" method="POST" enctype="multipart/form-data"  class="modal-body">
                        @csrf
                        <div><h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name" value="" placeholder=""></div>
                        @error('name') <small class="error-message">{{ $message }}</small> @enderror

                        <div><h4>Responsable:</h4><input class="@error('responsable') error-input @enderror" type="text" name="responsable" value="" placeholder=""></div>
                        @error('responsable') <small class="error-message">{{ $message }}</small> @enderror

                        <div><h4>Precio:</h4><input class="@error('amount') error-input @enderror" type="number" name="amount" value="" placeholder=""></div>
                        @error('amount') <small class="error-message">{{ $message }}</small> @enderror

                        <div>
                            <h4>Atractivo turístico:</h4>
                            <select name="location_id" id="" class="@error('location_id') error-input @enderror">
                                <option></option>
                                @foreach($locations as $address)
                                    @php($location = $address->addressable)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('location_id') <small class="error-message">{{ $message }}</small> @enderror

                        <div><h4>Inicio:</h4><input class="@error('start') error-input @enderror" type="datetime-local" name="start" value="" placeholder=""></div>
                        @error('start') <small class="error-message">{{ $message }}</small> @enderror

                        <div><h4>Fin:</h4><input class="@error('end') error-input @enderror" type="datetime-local" name="end" value="" placeholder=""></div>
                        @error('end') <small class="error-message">{{ $message }}</small> @enderror

                        <div
                            ><h4>Descripción:</h4>
                            <textarea class="@error('description') error-input @enderror" name="description" rows="6" placeholder="Escribe aquí la descripción"></textarea>
                        </div>
                        @error('description') <small class="error-message">{{ $message }}</small> @enderror

                        <div><h4>Foto:</h4><input class="@error('photos') error-input @enderror" type="file" name="photos[]" accept="image/png, .jpeg, .jpg" multiple></div>
                        @error('photos') <small class="error-message">{{ $message }}</small> @enderror

                        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="articles activities">
        @foreach($activities as $activity)
        <section class="article">
            <div class="article-info">
                <div class="info-1">
                    <b>Actividad:</b> {{ $activity->name }}</br>
                    <b>Responsable:</b> {{ Str::title($activity->responsable) }}</br>
                    <b>Precio:</b> ${{ $activity->amount }}
                </div>
                <div class="info-2">
                    <b>Atractivo turístico:</b> {{ $activity->location->name }}</br>
                    <b>Inicio:</b> {{ $activity->start->format('d/m/Y')}} a las {{ $activity->start->format('h:i') }} hs </br>
                    <b>Fin:</b> {{ $activity->end->format('d/m/Y') }} a las {{ $activity->end->format('h:i') }} hs
                </div>
                <div class="info-3">
                    <b>Descripción:</b> {{ $activity->description }}
                </div>
            </div>
            <div class="icon">
                <a href="{{ url('panel-de-administracion/photos/activities/'.$activity->id) }}" class="btn-show"><i class="icon-picture"></i></a>
                <a href="{{ url('panel-de-administracion/activities/'.$activity->id.'/edit') }}" class="btn-edit"><i class="icon-edit"></i></a>
                <form action="{{ url('panel-de-administracion/activities/'.$activity->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn-delete" type="submit"><i class="icon-trash-empty"></i></button>                  
                </form>
            </div>
        </section>
        @endforeach
    </div> 
</main>
@endsection


@section('scripts')
<script src="{{ asset('js/modal.js') }}"></script>


@if($errors->any())
    <script>
        const createForm = document.getElementById("miModal");
        createForm.style.display = "block";
    </script>
@endif

<script>
    const input = document.getElementById("activity-search");

    const filter = () => {
      const params = input.value.toLowerCase();
      const activities = document.getElementsByClassName("article");
   
      Array.from(activities).forEach((activity) => {
        const text = activity.getElementsByClassName("article-info")[0];
        const name = text.children[0].innerHTML.toLowerCase();

        if(name.includes(params)) {
            activity.style.display = "flex"
        } else {
            activity.style.display = "none"
        }
      });
    }

    input.addEventListener("keyup", filter);
  </script>
@endsection