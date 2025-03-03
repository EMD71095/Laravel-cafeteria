<div>
    <div class="card">
        <div class="card-header">
            <h4><i class="bi-people text-info"></i> Usuarios</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Correo</td>
                        <td>Incorporación</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td> <!-- Aquí está corregido el error -->
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.users.edit', $user)}}">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>