@extends('layout.master')
@section('content')
    @if (session('news-delete'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Notícia deletada com sucesso!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <div class="container">
        <label for="perPage" class="form-label">Notícias por página:</label>
        <select name="perPage" id="perPage">
            <option selected disabled>Selecione</option>
            <option value="4">4</option>
            <option value="6">6</option>
            <option value="12">12</option>
            <!-- Outras opções de quantidade de notícias por página -->
        </select>

        <div class="row justify-content-center">
            @foreach ($news as $n)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="row">
                            <div class="col d-flex align-items-center">
                                <img src="{{ asset($n->thumbnail) }}" class="mx-auto card-img">
                            </div>
                            <div class="col">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">{{ Str::limit($n->title, 8) }}</h5>
                                    <p class="card-text">Autor: {{ $n->user->name }}</p>
                                    <p class="card-text"><small
                                            class="text-muted">{{ date('d/m/Y', strtotime($n->created_at)) }}</small></p>
                                    <a href="{{ route('news.show', $n->id) }}" class="btn btn-primary mt-auto">Ver Mais</a>

                                    @if (optional(auth()->user())->role == 'admin' || $n->user_id == optional(auth()->user())->id)
                                        <hr>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('news.edit', $n->id) }}"
                                                class="btn btn-primary me-2">Editar</a>

                                            <button type="submit" class="btn btn-primary delete-item ms-2"
                                                data-item-id="{{ $n->id }}">Excluir</button>


                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination justify-content-center">
            {{ $news->links('pagination::bootstrap-4') }}
        </div>

    </div>
    <script>
        document.querySelectorAll('.delete-item').forEach(function(button) {
            button.addEventListener('click', function() {
                var itemId = this.getAttribute('data-item-id');

                Swal.fire({
                    title: 'Confirmar exclusão',
                    text: 'Tem certeza de que deseja deletar a notícia?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Deletar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = document.createElement('form');
                        form.action = '{{ route('news.delete', ':id') }}'.replace(':id', itemId);
                        form.method = 'POST';
                        form.innerHTML = '@csrf @method('DELETE')';

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
    <script>
        document.getElementById('perPage').addEventListener('change', function() {
            var perPage = this.value;
            window.location.href = '{{ route('home') }}?perPage=' + perPage;
        });
    </script>
@endsection
