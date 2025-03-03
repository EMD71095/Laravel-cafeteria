@extends('layouts.app')
@section('title', __('Detalle pedido'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><span class="text-center fa fa-home"></span> @yield('title')</h5>
                </div>
                <div class="card-body">
                    @if($ordenes)
                    <table class="table table-striped">
                        <thead>
                            <th>PRODUCTO</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                        </thead>
                        <tbody>
                            @foreach($ordenes as $item)
                            <tr class="align-middle">
                                <td>{{$item->productou->Nombre}}</td>
                                <td>{{$item->cantidad}}</td>
                                <td>${{number_format($item->precio,2)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No tienes pedidos, <a href="/">agrega algo al carrito</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection