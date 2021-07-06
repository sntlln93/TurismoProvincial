@extends('dashboard.layouts.app')

@section('styles')
    <style>
        .error-message {
            color: red;
            margin: 0 0 1em 0;
            font-weight: 500;
            text-align: right;
        }

        .error-input {
            border-color: red !important;
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="title-dashboard">
            <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
            <h2>Modificar experiencia</h2>
        </div>
        
        <div class="modal-body view">
            <form action="{{ url('panel-de-administracion/activities/'.$activity->id) }}" method="POST">
                @csrf @method('PUT')
                <div><h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name" value="{{ $activity->name }}" placeholder=""></div>
                @error('name') <small class="error-message">{{ $message }}</small> @enderror

                <div><h4>Responsable:</h4><input class="@error('responsable') error-input @enderror" type="text" name="responsable" value="{{ $activity->responsable }}" placeholder=""></div>
                @error('responsable') <small class="error-message">{{ $message }}</small> @enderror

                <div><h4>Precio:</h4><input class="@error('amount') error-input @enderror" type="number" name="amount" value="{{ $activity->amount }}" placeholder=""></div>
                @error('amount') <small class="error-message">{{ $message }}</small> @enderror

                <div>
                    <h4>Atractivo turístico:</h4>
                    <select class="@error('location_id') error-input @enderror" name="location_id" id="">
                        @foreach($locations as $address)
                            @php($location = $address->addressable)
                                <option value="{{ $location->id }}" @if($location->id == $activity->location_id) selected @endif>{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('location_id') <small class="error-message">{{ $message }}</small> @enderror

                <div><h4>Inicio:</h4><input class="@error('start') error-input @enderror" type="datetime-local" id="start" name="start" value="{{ $activity->start->format('Y-m-d') }}T{{ $activity->start->format('h:i') }}" placeholder=""></div>
                @error('start') <small class="error-message">{{ $message }}</small> @enderror

                <div><h4>Fin:</h4><input class="@error('end') error-input @enderror" type="datetime-local" id="end" name="end" value="{{ $activity->end->format('Y-m-d') }}T{{ $activity->end->format('h:i') }}" placeholder=""></div>
                @error('end') <small class="error-message">{{ $message }}</small> @enderror

                <div
                    ><h4>Descripción:</h4>
                    <textarea class="@error('description') error-input @enderror" name="description" rows="6" placeholder="Escribe aquí la descripción">{{ $activity->description }}</textarea>
                </div>
                @error('description') <small class="error-message">{{ $message }}</small> @enderror

                <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
            </form>
        </div>
    </main>
@endsection

@section('scripts')
@endsection