@extends('layouts.app')

@section('content')
    <h1>Groups</h1>
    <a href="{{ route('groups.create') }}">Add Group</a>
    <ul>
        @foreach ($groups as $group)
            <li>{{ $group->name }}
                <a href="{{ route('groups.edit', $group) }}">Edit</a>
                <form action="{{ route('groups.destroy', $group) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
