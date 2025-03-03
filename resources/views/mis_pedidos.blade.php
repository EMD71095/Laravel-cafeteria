@extends('layouts.app')
@section('title', __('Mis pedidos'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi-bag-check text-info"></i> Mis pedidos</h4>
                </div>
                <div class="card-body">
                    @if($pedidos)
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <th>ID</th>
                            <th>FECHA</th>
                            <th>ORDEN</th>
                            <th>ESTADO</th>
                            <th>TOTAL</th>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $item)
                            <tr class="align-middle">
                                <td>{{$item->id}}</td>
                                <td>{{$item->Fecha}}</td>
                                <td><a href="{{route('detalle_pedido', $item->orden_id)}}">{{$item->orden_id}}</a></td>
                                <td>{{$item->estado}}</td>
                                <td>${{number_format($item->total,2)}}</td>
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