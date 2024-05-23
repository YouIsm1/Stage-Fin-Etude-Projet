

@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        <h1>test</h1>

        @if(session()->has('utilisateur'))
            <h1>Hello {{ session('utilisateur.nom') }} with the role is {{ session('utilisateur.role.nom_de_role') }}</h1>
        @else
            <p>No user data available.</p>
        @endif
    </div>
@endsection
