@extends('layout.master')
@section('content')
@if (session('user-delete'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Usuário deletada com sucesso!',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Todos os usuários
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tabela">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Notícias Criadas</th>
                                        <th>Ações</th>
                                </thead>
                                <tbody>
                                    @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $u->id }}</td>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ $u->news_count   }}</td>
                                            <td><a href="{{ route('admin.user.edit', $u->id) }}"
                                                class="btn btn-primary">Editar</a>
                                                <button type="button" class="btn btn-primary delete-item" data-item-id="{{ $u->id }}">
                                                    Deletar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Event listener para o botão de exclusão
        document.querySelectorAll('.delete-item').forEach(function(button) {
          button.addEventListener('click', function() {
            var itemId = this.getAttribute('data-item-id');
      
            Swal.fire({
              title: 'Confirmar exclusão',
              text: 'Tem certeza de que deseja deletar o item?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Deletar',
              cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.isConfirmed) {
                var form = document.createElement('form');
                form.action = '{{ route("user.delete", ":id") }}'.replace(':id', itemId);
                form.method = 'POST';
                form.innerHTML = '@csrf @method("DELETE")';
      
                document.body.appendChild(form);
                form.submit();
              }
            });
          });
        });
      </script>
@endsection
