@extends('layouts.app')

@section('title', 'Edit Emission')

@section('content')
<div class="container">
    <h2>Edit Emission</h2>
    <form action="{{ route('emission.update', $emission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $emission->name }}" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="food" {{ $emission->type == 'food' ? 'selected' : '' }}>Food</option>
                <option value="energy" {{ $emission->type == 'energy' ? 'selected' : '' }}>Energy</option>
                <option value="transportation" {{ $emission->type == 'transportation' ? 'selected' : '' }}>Transportation</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="emission" class="form-label">Emission(for each 1/4kg)</label>
            <input type="number" step="0.01" class="form-control" id="emission" name="emission" value="{{ $emission->emission }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
