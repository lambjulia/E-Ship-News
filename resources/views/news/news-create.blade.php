@extends('layout.master')
@section('content')
@if (session('news-store'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Notícia criada com sucesso!',
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
                        Cadastre uma nova Notícia
                    </div>
                    <div class="card-body">
                        <form action="{{ route('news.store') }}" method="post" role="form"  enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Título</label>
                                    <input type="text" id="title" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Título da sua notícia">
                                    @error('title')
                                        <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Descrição</label>
                                        <textarea class="form-control  @error('description') is-invalid @enderror"
                                        placeholder="Escreva sua notícia aqui" id="description" name="description" rows="3"></textarea>
                                    @error('description')
                                        <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Imagem de Capa</label>
                                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                                        class="form-control @error('image') is-invalid @enderror">
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
                                    <select class="form-select" id="multiple-select-tags" name="tags[]" data-placeholder="Escolha as Tags" multiple>
                                        <option value="futebol">Futebol</option>
                                        <option value="musica">Música</option>
                                        <option value="tecnologia">Tecnologia</option>
                                        <option value="politica">Política</option>
                                        <option value="jogos">Jogos</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $( '#multiple-select-tags' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    closeOnSelect: false,
} );
</script>
@endsection
