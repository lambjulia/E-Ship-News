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
    @if (session('logout'))
        <script>
            Swal.fire({
                position: 'top-end',
                title: 'Você esta deslogado',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (session('login'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Você esta loggado',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="perPage" class="form-label">Notícias por página:</label>
                    <select name="perPage" id="perPageSelect" class="btn btn-mini">
                        <option selected disabled>Selecione</option>
                        <option value="3">3</option>
                        <option value="6">6</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="format" class="form-label">Formato de Exibição:</label>
                    <select id="format" class="btn btn-mini">
                        <option selected value="grid">Grid</option>
                        <option value="lines">Lines</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('news.filter') }}" method="GET">
                            <h6>Pesquisar</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <input class="form-control mb-3" type="text" name="title" id="title"
                                        value="{{ request('title') }}" placeholder="Título">
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select mb-3" name="tagFilter" id="tagFilter">
                                        <option selected disabled>Tags</option>
                                        <option value="futebol">Futebol</option>
                                        <option value="musica">Música</option>
                                        <option value="tecnologia">Tecnologia</option>
                                        <option value="politica">Política</option>
                                        <option value="jogos">Jogos</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mt-auto">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="grid">
            <div class="row justify-content-center">
                @foreach ($news as $n)
                    <div class="col-md-4 mb-4">
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
                                                class="text-muted">{{ date('d/m/Y', strtotime($n->created_at)) }}</small>
                                        </p>
                                        <a href="{{ route('news.show', $n->id) }}" class="btn btn-primary mt-auto">Ver
                                            Mais</a>

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
        </div>
        <div id="lines" style="display: none;">
            <div class="row justify-content-center">
                @foreach ($news as $n)
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="row">
                                <div class="col d-flex align-items-center">
                                    <img src="{{ asset($n->thumbnail) }}" class="mx-auto card-img">
                                </div>
                                <div class="col">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold">{{ $n->title }}</h5>
                                        <p class="card-text">{{ $n->description }}</p>
                                        <p class="card-text">Autor: {{ $n->user->name }}</p>

                                        @php
                                            $selectedOptions = explode(',', $n->tags);
                                        @endphp

                                        <div class="container">
                                            <div class="d-flex gap-1">
                                                <p class="card-text">Tags: </p>
                                                @foreach ($selectedOptions as $item)
                                                    <div>
                                                        <p> #{{ $item }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <hr>

                                        <p class="card-text">{{ date('d/m/Y', strtotime($n->created_at)) }}</p>
                                        <p class="card-text">Visualizações: {{ $n->views }}</p>
                                        <p class="card-text"><small
                                                class="text-muted">{{ date('d/m/Y', strtotime($n->created_at)) }}</small>
                                        </p>
                                        <a href="{{ route('news.show', $n->id) }}" class="btn btn-primary mt-auto">Ver
                                            Mais</a>

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

        document.addEventListener('DOMContentLoaded', function() {
            var currentPath = window.location.pathname;

            var perPageSelect = document.getElementById('perPageSelect');
            perPageSelect.addEventListener('change', function() {
                var perPage = this.value;
                var currentPage = '{{ $news->currentPage() }}';
                var newUrl = getUpdatedUrl(currentPath, 'perPage', perPage, currentPage);
                window.location.href = newUrl;
            });

            var pageLinks = document.getElementsByClassName('page-link');
            for (var i = 0; i < pageLinks.length; i++) {
                pageLinks[i].addEventListener('click', function(e) {
                    e.preventDefault();
                    var perPage = '{{ $news->perPage() }}';
                    var page = this.getAttribute('href').split('page=')[1];
                    var newUrl = getUpdatedUrl(currentPath, 'perPage', perPage, page);
                    window.location.href = newUrl;
                });
            }

            var tagFilter = document.getElementById('tagFilter');
            tagFilter.addEventListener('change', function() {
                var tag = this.value;
                var newUrl = getUpdatedUrl(currentPath, 'tag', tag);
                window.location.href = newUrl;
            });

            var format = document.getElementById('format');
            var grid = document.getElementById('grid');
            var lines = document.getElementById('lines');

            format.addEventListener('change', function() {
                var selectedCard = this.value;

                if (selectedCard === 'grid') {
                    grid.style.display = 'block';
                    lines.style.display = 'none';
                } else if (selectedCard === 'lines') {
                    grid.style.display = 'none';
                    lines.style.display = 'block';
                }
            });
        });

        function getUpdatedUrl(currentPath, param, value, page = null) {
            var url = '{{ route('home') }}';

            if (currentPath === '/minhas-noticias') {
                url = '{{ route('user.news') }}';
            }

            var urlObj = new URL(url);
            urlObj.searchParams.set(param, value);

            if (page) {
                urlObj.searchParams.set('page', page);
            }

            return urlObj.toString();
        }
    </script>
@endsection
