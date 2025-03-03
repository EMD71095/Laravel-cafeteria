@extends('layouts.app')
@section('title', __('Menu'))
@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5><span class="text-center fa fa-home"></span>Menú</h5>
				</div>
				<div class="card-body">
					<h5>Bienvenido a la cafeteria, <strong>{{ Auth::user()->name }}</strong>, ¿Qué vas a ordenar hoy?</h5>
					<hr>
					<div class="row">
						@include('partials.msg')
							@foreach($productos as $producto)
							<div class="col-3">
								<div class="card">
									<div class="card-header text-center">
										<h5>{{ $producto->Nombre}}</h5>
									</div>
									<div class="card-body text-center">
										<img class="card-img-top text-center" src="{{ Storage::url('public/' . $producto->image) }}" alt="img_product" style="width: 250px; height: 250px;">
										<p>Descripción: {{ $producto->Desc }}</p>
										<h6>Precio: <h5>${{ $producto->Precio }}</h5>
										</h6>
									</div>
									<div class="card-footer">
										<form action="{{route('add')}}" method="post">
											@csrf
											<input type="hidden" name="id" value="{{$producto->id}}">
											<input type="submit" name="btn" class="btn btn-success w-100" value="Añadir al carrito">
										</form>
									</div>
								</div>
							</div>
							@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection