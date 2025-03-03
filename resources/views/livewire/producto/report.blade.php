<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Reporte de productos</title>
</head>

<body>
    <h2 class="text-center">Listado de productos</h2>
    <table class="table table-bordered table-sm">
        <thead class="thead">
            <tr>
                <td>#</td>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $producto->Nombre }}</td>
                <td>{{ $producto->Desc }}</td>
                <td>{{ $producto->Precio }}</td>
                <td style="text-align: center;">
                    <img src="{{ public_path() . '/storage/' . $producto->image }}" width="50px" alt="Producto">
                </td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="5">No se encontraron productos</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>