@extends('admin.layout.main')

@section('content')
<div class="container">
    <h2>Are you sure you want to log out?</h2>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Log Out</button>
    </form>
</div>
@endsection

