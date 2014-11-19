<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('/') }}">{{ Config::get('app.title') }}</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ set_active('search') }}">{{ link_to_route('search.index', 'Search') }}</li>
                @if(Auth::guest())
                <li>{{ link_to_action('UsersController@login', 'Login') }}</li>
                <li>{{ link_to_action('UsersController@create', 'Signup') }}</li>
                @else
                <li class="{{ set_active('ingredients') }}">{{ link_to_route('ingredients.index', 'Ingredients') }}</li>
                <li class="{{ set_active('recipes') }}">{{ link_to_route('recipes.index', 'Recipes') }}</li>
                <li>{{ link_to_action('UsersController@logout', 'Logout') }}</li>
                @endif
            </ul>
        </div>
    </div>
</nav>
