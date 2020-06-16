@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="appartamenti-manager col-4">
        <img class="apt-mng-img" src="https://wellkeptwallet.com/wp-content/uploads/Apartment-for-Air-BNB-rental.jpg" alt="">
      </div>
      <div class="appartamenti-manager col-4">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="appartamenti-manager tasti col-4">
        <div class="tasto">
          <div class="btn btn-primary">
            Vedi
          </div>
        </div>
        <div class="tasto">
          <div class="btn btn-secondary">
            Modifica
          </div>
        </div>
        <div class="tasto">
          <form class="" action="index.html" method="post">
            <input class="btn btn-danger" type="submit" name="" value="Elimina">
          </form>
        </div>
      </div>
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
