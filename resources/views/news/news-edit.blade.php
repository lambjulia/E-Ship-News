@extends('layout.master')
@section('content')
    @if (session('news-update'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Notícia editada com sucesso!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (session('image-delete'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Imagem deletada com sucesso!',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Edite sua Notícia
                    </div>
                    <div class="card-body">
                        <form action="{{ route('news.update', $news->id) }}" method="post" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Título</label>
                                    <input type="text" id="title" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Título da sua notícia" value="{{ $news->title }}">
                                    @error('title')
                                        <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Descrição</label>
                                    <textarea class="form-control  @error('description') is-invalid @enderror" placeholder="Escreva sua notícia aqui"
                                        id="description" name="description" rows="3"> {{ $news->description }}</textarea>
                                    @error('description')
                                        <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Imagem de Capa</label>
                                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                                        class="form-control @error('image') is-invalid @enderror"
                                        value="{{ $news->thumbnail }}">
                                    @error('image')
                                        <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="image" class="form-label">Imagens da Notícia</label>
                                    <input type="file" id="image" name="image[]" multiple accept="image/*"
                                        class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tags</label>
                                    <select class="form-select" id="multiple-select-tags" name="tags[]"
                                        data-placeholder="Escolha as Tags" multiple>
                                        
                                        <option value="futebol"  {{ in_array('futebol', explode(',', $news->tags)) ? 'selected' : '' }}>Futebol</option>
                                        <option value="musica"  {{ in_array('musica', explode(',', $news->tags)) ? 'selected' : '' }}>Música</option>
                                        <option value="tecnologia"  {{ in_array('tecnologia', explode(',', $news->tags)) ? 'selected' : '' }}>Tecnologia</option>
                                        <option value="politica"  {{ in_array('politica', explode(',', $news->tags)) ? 'selected' : '' }}>Política</option>
                                        <option value="jogos"  {{ in_array('jogos', explode(',', $news->tags)) ? 'selected' : '' }}>Jogos</option>
                                      
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                        <hr>
                        <div class="row">
                            @foreach ($news->images as $image)
                                <div class="col-md-4 d-flex mb-3">
                                    <div class="card" style="width: 18rem;">
                                        <img src="{{ asset($image->path) }}" alt="Imagem do produto"
                                            class="mx-auto d-block w-100 card-img-top">
                                            <div class="card-footer text-center">
                                            <button type="button" class="btn btn-primary delete-item  mx-auto" data-item-id="{{ $image->id }}">
                                                Deletar
                                              </button>
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
    <script>
        $('#multiple-select-tags').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            closeOnSelect: false,
        });
    </script>
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
                form.action = '{{ route("image.delete", ":id") }}'.replace(':id', itemId);
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
