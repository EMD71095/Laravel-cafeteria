@section('title', __('Producto'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="bi-tag text-info"></i>
							Productos </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Productos">
						</div>
						<div>
							<a href="{{ route('livewire.producto.report') }}" class="btn btn-sm btn-success" target="new"><i class="bi-check-circle"></i> Generar PDF</a>
						</div>
						&nbsp;
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="bi-plus-lg"></i>  Añadir producto
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.producto.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>No</td> 
								<th>Nombre</th>
								<th>Descripcion</th>
								<th>Precio</th>
								<th>Imagen</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@forelse($productos as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->Nombre }}</td>
								<td>{{ $row->Desc }}</td>
								<td>${{number_format($row->Precio, 2)}}</td>
								<td style="text-align: center;">
										<img src="{{ Storage::url('public/' . $row->image) }}" width="50px" alt="">
									</td>
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Actions
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="bi-pencil-square"></i> Edit </a></li>
											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Producto id {{$row->id}}? \nDeleted Productos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="bi-trash3-fill"></i> Delete </a></li>  
										</ul>
									</div>								
								</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>						
					<div class="float-end">{{ $productos->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>