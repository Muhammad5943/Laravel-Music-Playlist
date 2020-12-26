<div class="form-group">
    <label for="thumbnail">Thumbnail</label>
    <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
</div>
@error('thumbnail')
    <div class="mt-2 text-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $band->name }}">
</div>
@error('name')
    <div class="mt-2 text-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="genres">Choose Genres</label>
    <select name="genres[]" id="genres" class="form-control select2multiple" multiple>
        @foreach ($genres as $genre)
            <option {{ $band->genres()->find($genre->id) ? 'selected' : '' }} value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select>
</div>
@error('genres')
    <div class="mt-2 mb-2 text-danger">{{ $message }}</div>
@enderror

<button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>