@extends('layout.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card-body">
                    <div class="col">
                        <div class="card mb-3">
                            <img src="{{ asset($news->thumbnail) }}" class="mx-auto card-img-top">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $news->title }}</h5>
                                <p class="card-text">{{ $news->description }}</p>
                                <p class="card-text">Autor: {{ $news->user->name }}</p>

                                <div class="row">
                                    <p class="card-text">Clique nas imagens para ampliá-las:</p>
                                    @foreach ($news->images as $image)
                                        <div class="col-md-3 d-flex mb-3">
                                            <div class="card" style="width: 18rem;">
                                                
                                                <img src="{{ asset($image->path) }}" alt="Imagem do produto"
                                                    class="mx-auto d-block w-100 card-img-top" 
                                                    data-bs-toggle="modal" data-bs-target="#modalImagem{{ asset($image->path) }}">
                                                
                                            </div>
                                        </div>
                                        <div class="modal fade" id="modalImagem{{ asset($image->path) }}" tabindex="-1" aria-labelledby="modalImagemLabel{{ asset($image->path) }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <img src="{{ asset($image->path) }}" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>



                                <div class="container">
                                    <div class="row">
                                        <p class="card-text">Tags:</p>
                                        @foreach ($valores as $item)
                                            <div class="col-md-2">
                                                <div class="card border-primary">
                                                    <div class="card-body">
                                                        {{ $item }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                
                                <p class="card-text">{{ date('d/m/Y', strtotime($news->created_at)) }}</p>
                                <p class="card-text">Visualizações: {{ $news->views }}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
