@extends('view::main')
@section('content')
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form method="POST" action="{{ isset($item) ? route('items.update', $item->id) : route('items.store') }}">
                <div class="form-group">
                    <label for="name">Nazwa</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Wprowadź tytuł" value="{{ isset($item->name) ? $item->name : '' }}" required>
                </div>
                <div class="form-group">
                    <label for="amount">Ilość</label>
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Wprowadź ilość" value="{{ isset($item->amount) ? $item->amount : '' }}" required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Zapisz</button>
                <a href="{{ url('items') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Powrót</a>
                @if(isset($item))
                    {{ method_field('PUT') }}
                @endif
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
@endsection