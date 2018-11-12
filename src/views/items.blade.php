@extends('view::main')
@section('content')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-9">
                    <form class="form-inline" method="GET">
                        <div class="form-group">
                            <select class="form-control" name="filter">
                                <option value="{{ \Matiww\Plugin\PluginController::ALL_PRODUCTS }}" {{ $filter == \Matiww\Plugin\PluginController::ALL_PRODUCTS ? 'selected' : '' }}>Wszystkie produkty</option>
                                <option value="{{ \Matiww\Plugin\PluginController::AVAILABLE_PRODUCTS }}" {{ $filter == \Matiww\Plugin\PluginController::AVAILABLE_PRODUCTS ? 'selected' : '' }}>Produkty znajdujące się na składzie</option>
                                <option value="{{ \Matiww\Plugin\PluginController::NOT_AVAILABLE_PRODUCTS }}" {{ $filter == \Matiww\Plugin\PluginController::NOT_AVAILABLE_PRODUCTS ? 'selected' : '' }}>Produkty nie znajdujące się składzie</option>
                                <option value="{{ \Matiww\Plugin\PluginController::PRODUCTS_MORE_THAN_5 }}" {{ $filter == \Matiww\Plugin\PluginController::PRODUCTS_MORE_THAN_5 ? 'selected' : '' }}>Produkty znajdujące się na składzie w ilości większej niż 5</option>
                            </select>
                            <button class="btn btn-success filter" type="submit"><i class="fa fa-filter"></i> Filtruj</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('items/create') }}" class="btn btn-primary"><i class="fa fa-plus"> Dodaj</i></a>

                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center" scope="col">Nazwa</th>
                    <th class="text-center" scope="col">Ilość</th>
                    <th class="text-center" scope="col">Akcje</th>
                </tr>
                </thead>
                <tbody>
                @if(count($items) > 0)
                    @foreach($items as $item)
                        <tr>
                            <td class="text-center item-name">{{ $item->name }}</td>
                            <td class="text-center">{{ $item->amount }}</td>
                            <td class="text-center">
                                <div class="form-actions" style="display: inline-block">
                                    <div class="edit-item" style="display: inline-block">
                                        <a href="{{ url('/items/'.$item->id.'/edit') }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    </div>
                                    <div class="delete-item" style="display: inline-block">
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-primary"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <td class="text-center" colspan="3">Brak elementów do wyświetlenia</td>
                    </div>
                    <div class="col-md-4"></div>
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection