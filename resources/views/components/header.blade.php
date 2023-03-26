<header class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Tenth navbar example">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08"
                aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col-2">
        </div>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/">list-posts</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="/list-categories">list-categories</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="/list-tags">list-tags</a>--}}
{{--                            </li>--}}
                        </ul>
        </div>
        <div class="col-2 text-end">
            @if(Illuminate\Support\Facades\Auth::check())
                <a type="button" href="/logout" class="btn btn-outline-primary me-2">Logout</a>
            @else
                @if(basename(parse_url(Illuminate\Support\Facades\URL::current(), PHP_URL_PATH)) !== 'login')
                    <a type="button" href="/login" class="btn btn-outline-primary me-2">Login</a>
                @endif
            @endif
        </div>
    </div>
</header>
