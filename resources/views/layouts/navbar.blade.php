<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">

        <div class="header-search">
            <form action="{{ route('search') }}" id="search" method="POST">
                {{ csrf_field() }}
                <label class="form-control header-search-wrapper">
                    <input type="text" name="search" id="search-input" class="form-control header-search-input" placeholder="Search repository in GitHub">
                    <input type="text" name="lang"  id="lang-input" class="form-control header-search-input" placeholder="Language">
                </label>
            </form>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>

                @else
                    <li><a href="{{ route('home') }}">HOME</a></li>
                    <li><a href="{{ route('topRepo') }}">TOP REPOSITORIES</a></li>
                    <li><a href="{{ route('tracking') }}">EVENT TRACKING</a></li>
                    <li><a href="{{ route('cabinet') }}"></a></li>

                    <li class="dropdown pull-left">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            PERSONAL AREA <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('cabinet') }}">PLANS</a></li>
                            <li><a href="{{ route('personal-data') }}">PERSONAL DATA</a></li>
                            <li><a href="{{ route('invoices') }}">INVOICES</a></li>
                        </ul>

                    </li>

                    <li class="dropdown pull-left">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>






        </div>

        <div class="navbar-header pull-right">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-collapse">
                <div class="sr-only">Toggle navigation</div>
                <div class="icon-bar"></div>
                <div class="icon-bar"></div>
                <div class="icon-bar"></div>
            </button>
        </div>

    </div>
</nav>


