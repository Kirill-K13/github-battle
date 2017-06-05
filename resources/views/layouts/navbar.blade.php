<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">

        <div class="header-search">
            <form action="{{ route('search') }}"  method="POST">
                {{ csrf_field() }}
                <label class="form-control header-search-wrapper">
                    <input type="text" name="search" class="form-control header-search-input" placeholder="Search repository in GitHub">
                </label>

            </form>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li><a href="/">HOME</a></li>
                <li><a href="{{ route('topRepo') }}">TOP REPOSITORIES</a></li>

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


