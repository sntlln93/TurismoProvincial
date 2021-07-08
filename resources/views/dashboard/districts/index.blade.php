@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title">
        <h2>Municipios</h2>
    </div>

    <div class="articles district">
        @foreach($districts as $district)
            <div class="article district-container">
                <div class="article-info">
                    <div>
                        <p><b>{{ $district->name }}</b></p>
                        <p>Intendente: {{ Str::title($district->mayor) }}</p>
                    </div>
                    <div>
                        <a href="{{ url('panel-de-administracion/districts/'.$district->id.'/edit') }}" class="btn btn__edit" id="open-edit"><i class="icon-edit"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div> 
</main>
@endsection

@section('scripts')
@endsection