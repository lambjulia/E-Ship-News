@extends('layout.master')
@section('content')
@if (session('user-update'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Seu perfil foi editado com sucesso!',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Se cadastre
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update') }}" method="post" role="form">
                        @csrf
                        <div class="row g-3"> 
                            <div class="col-12">
                            <label class="form-label">Nome</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Nome Completo" value="{{ $user->name }}">
                                @error('name')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="text" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="exemplo@exemplo.com"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Senha</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Senha com números e letras.">
                                @error('password')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection