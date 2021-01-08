@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title">
        <h2>¡Bienvenido/a, {{ Auth::user()->name }}!</h2>
        <br>
        <p>Usá el menú para moverte entre las distintas secciones de este panel de administración.</p>
    </div>
    
    
</main>
@endsection

@section('scripts')
@endsection