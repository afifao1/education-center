@extends('layouts.app')

@section('content')
    <h1>Edit Group</h1>
    <form action="{{ route('groups.update', $group) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $group->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
