@section('title', __('Pedidos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="bi-list text-info"></i>
							Lista de pedidos </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Pedidos">
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.pedido.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Fecha</th>
								<th>Orden Id</th>
								<th>Nombre de usuario</th>
								<th>Estado</th>
								<th>Total</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@forelse($pedidos as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->Fecha }}</td>
								<td>{{ $row->orden_id }}</td>
								<td>{{ $row->usuario->name }}</td>
								<td>{{ $row->estado }}</td>
								<td>${{number_format($row->total, 2)}}</td>
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Actions
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="bi-pencil-square"></i> Edit </a></li>
											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Pedido id {{$row->id}}? \nDeleted Pedidos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="bi-trash3-fill"></i> Delete </a></li>  
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
					<div class="float-end">{{ $pedidos->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>