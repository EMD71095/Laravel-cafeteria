@extends('layouts.app')
@section('title', __('Checkout'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                @if(Cart::count())
                <table class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO UNITARIO</th>
                        <th>IMPORTE</th>
                    </thead>
                    <tbody>
                        @foreach(Cart::content() as $item)
                        <tr class="align-middle">
                            <td><img src="{{ Storage::url('public/' . $item->options->image) }}" style="width: 100px;" alt=""></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{number_format($item->price, 2)}}</td>
                            <td>{{number_format($item->qty*$item->price, 2)}}</td>
                            <td>
                                <form action="{{route('removeitem')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="rowId" value="{{$item->rowId}}">
                                    <input type="submit" name="btn" class="btn btn-danger btn-sm" value="x">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="fw-bolder">
                            <td colspan="3"></td>
                            <td class="text-end">Subtotal</td>
                            <td class="text-end">{{Cart::subtotal()}}</td>
                            <td></td>
                        </tr>
                        <tr class="fw-bolder">
                            <td colspan="3"></td>
                            <td class="text-end">Uso de servicio</td>
                            <td class="text-end">{{number_format(15,2)}}</td>
                            <td></td>
                        </tr>
                        <tr class="fw-bolder">
                            <td colspan="3"></td>
                            <td class="text-end">Total</td>
                            <td class="text-end">{{number_format((Cart::total()-Cart::tax()) + 15, 2)}}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{route('clear')}}" class="btn btn-danger text-center">Vaciar carrito</a>
                <a style="margin-left: 130px;" href="{{route('pedir')}}" class="btn btn-success text-align-right">Completar pedido</a>
                @else
                <a href="/" class="btn btn-info text-center">Agrega algo al carrito</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection