@extends('base')

@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <div id="login-form">
            <h2 class="text-center">Connexion</h2>
            <form method="post">
                <div class="form-group my-3">
                    <label for="login"></label>
                    <input type="text" name="login" id="login" class="form-control" placeholder="Login" required/>
                </div>
                <div class="form-group mb-3">
                    <label for="password"></label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control" required/>
                </div>
                <div>
                    <input type="submit" value="Connexion" class="btn btn-outline-primary">
                    <a href="{{$registerUrl}}" class="float-end btn">Créer un compte</a>
                </div>
            </form>
        </div>
    </div>
@endsection