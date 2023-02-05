@extends('base')

@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <div id="login-form">
            <h2>Connexion</h2>
            <form method="post">
                <div class="form-group my-3">
                    <input type="text" name="login" class="form-control" placeholder="Login" required/>
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password" placeholder="Mot de passe" class="form-control" required/>
                </div>
                <input type="submit" value="Connexion" class="btn btn-outline-primary">
            </form>
        </div>
    </div>
@endsection