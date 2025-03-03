@section('title', __('Ordens'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="bi-clipboard-check text-info"></i>
							Lista de ordenes</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Ordens">
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.orden.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th>No Pedido</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@forelse($ordens as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->productou->Nombre }}</td>
								<td>{{ $row->cantidad }}</td>
								<td>${{number_format($row->precio,2)}}</td>
								<td>{{ $row->no_pedido }}</td>
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Actions
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="bi-pencil-square"></i> Edit </a></li>
											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Orden id {{$row->id}}? \nDeleted Ordens cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="bi-trash3-fill"></i> Delete </a></li>  
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
					<div class="float-end">{{ $ordens->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>