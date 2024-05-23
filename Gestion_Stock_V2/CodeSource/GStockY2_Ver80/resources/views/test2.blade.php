
@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        <h1>test</h1>

        @if(isset($authUser))
            <h1>Hello {{ $authUser->nom }} with the role is {{ $authUser->role->nom_de_role }}</h1>
        @else
            <p>No user data available.</p>
        @endif
    </div>
@endsection