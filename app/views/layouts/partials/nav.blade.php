<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
  <div class="container">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Blog</a>
    </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/">home</a></li>
        <li>{{ link_to_action('PostsController@index', 'posts') }}</li>
        <li>{{ link_to_action('UsersController@index', 'members') }}</li>
      </ul>

    <ul class="nav navbar-nav navbar-right">
        @if ( ! Auth::check())
        <li class="navbar-right">{{ link_to_action('UsersController@create', 'register') }}</li>
        <li class="navbar-right">{{ link_to_action('SessionsController@create', 'login') }}</li>
    @else
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li>{{ link_to_action('SessionsController@destroy', 'log out') }}</li>

          </ul>
        </li>
    @endif
      </ul>

      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
  </div>
</nav>
