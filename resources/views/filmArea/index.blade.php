@extends('layouts.rafaelLobo');

@section('header')
    <x-header-general />
@endsection

@section('content')
    @foreach ($filmAreas as $area)
        {{ $area->area }}
        <form action="{{ route('area.destroy', [$area->id]) }}" method="POST"
            onsubmit="return confirm('Tem certeza que deseja deletar este item?');">
            @csrf
            @method('DELETE')
            <button type="submit">Deletar</button>
        </form>
    @endforeach
@endsection

@section('footer')
    <x-footer />
@endsection
