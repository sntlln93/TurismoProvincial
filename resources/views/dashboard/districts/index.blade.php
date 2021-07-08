@extends('dashboard.layouts.app')

@section('styles')
<style>
    .btn {
        border: 1px solid var(--border-color);
        border-radius: 5px;
        cursor: pointer;
        padding: 5px;
        margin-left: 8px;
    }

    .btn__edit {
        background-color: rgb(255, 177, 88);
        color: #FAFAFA;
    }

    .btn__edit:hover {
        background-color: #FAFAFA;
        color: rgb(255, 177, 88);
    }

    @media (max-width: 600px) {
        .district-container {
            width: 100%;
        }
    }
</style>
@endsection

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
                    <a href="{{ url('dashboard/districts/'.$district->id.'/edit') }}" class="btn btn__edit"
                        id="open-edit"><i class="icon-edit"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</main>
@endsection

@section('scripts')
@endsection