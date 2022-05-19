<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Login | FOT Blog</title>

    <!-- Bootsrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/1a7c6bf0b4.js" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <link href="{{asset('/css/common.css')}}" rel="stylesheet">
</head>

<body>
    <div class="row justify-content-center mx-0" style="margin-top:5rem">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h5 class="card-title pt-1">FOT Blog</h5>
                    <h6 class="card-title">Admin Login</h6>
                </div>
                <div class="card-body m-3">
                    <form action="{{route('adminLogin')}}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-12 ">
                                @if(Session::has('status'))
                                <div class="alert alert-danger py-1" role="alert">
                                    {{Session::get('status')}}
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="mb-2" for="email">Email Address </label>
                                    <input type="email" class="form-control" placeholder="Email Address" name="email" id="email" autofocus required maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12 ">
                                <div class="form-group">
                                    <label class="mb-2" for="password">Password </label>
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" required maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div style="text-align:right;">
                            <input class="btn btn-primary px-4" type="submit" value="Sign In">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <a href="{{route('home')}}">
            Login as User
        </a>
    </div>
</body>

</html>