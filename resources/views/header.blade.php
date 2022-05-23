<nav class="navbar navbar-expand-lg navbar-light shadow-sm py-0 px-4">

    <a class="navbar-brand" href="{{route('home')}}">
        <img src="/img/logo.jpg" width="100%" height="60" alt="FOT BLOG">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav ">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('pages', 'Techno Media')}}">Techno Media</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('pages', 'Sports')}}">Sports</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">

        </ul>

    </div>

</nav>