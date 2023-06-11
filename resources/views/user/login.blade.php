@extends('layout.login')
@section('content')
    @if (session('user-store'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Usuário criado com sucesso!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <section class="text-center text-lg-start">
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card cascading-right"
                        style="
              background: hsla(195, 67%, 98%, 0.55);
              backdrop-filter: blur(30px);
              ">
                        <div class="card-body p-5 shadow-5 text-center">
                            <h2 class="fw-bold mb-5">Entre na sua conta</h2>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('authenticate') }}" method="post" role="form">
                                @csrf
                                <div class="form-outline mb-4">
                                    <input type="email" id="email" name="email" class="form-control" />
                                    <label class="form-label" for="email">Email</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="password" name="password" class="form-control" />
                                    <label class="form-label" for="password">Senha</label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Entrar
                                </button>

                                <div class="text-center">
                                    <a href="{{ route('forget.password.get') }}">Esqueci Minha Senha</a>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <a href="{{ route('user.create') }}" class="btn btn-primary">Se Cadastre Aqui
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0" class="conteudo">
                    <img src="{{ url('assets/img/jornais.png') }}" class="w-100 rounded-4 shadow-4 imagem" alt=""/>
                </div>
            </div>
        </div>
    </section>
    <style>
      /* Estilo para dispositivos móveis */
      @media (max-width: 767px) {
        .imagem {
          display: none;
        }
      }
    </style>
@endsection
