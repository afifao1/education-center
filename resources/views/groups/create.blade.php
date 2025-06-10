@extends('layouts.app')

@section('content')
    <h1>Add Group</h1>
    <form action="{{ route('groups.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Group Name" required>
        <button type="submit">Save</button>
    </form>
@endsection
