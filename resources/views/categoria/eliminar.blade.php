@foreach($categories as $categoria)
    <tr>
        <td>{{ $categoria->id_categoria }}</td>
        <td>{{ $categoria->nom_categoria }}</td>
        <td>
            <form action="{{ route('categoria.eliminar', $categoria->id_categoria) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </td>
    </tr>
@endforeach
