<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
  <div class="container">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Blog</a>
    </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/">home</a></li>
        <li>{{ link_to_action('PostsController@index', 'posts') }}</li>
      </ul>

      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>

    <ul class="nav navbar-nav navbar-right">
        @if ( ! Auth::check())
        <li class="navbar-right">{{ link_to_action('SessionsController@create', 'login') }}</li>
    @else
        <li class="navbar-right">{{ link_to_action('SessionsController@destroy', 'log out') }}</li>
    @endif
      </ul>
  </div>
</nav>



 <!--        <div class="row">
            <div class="col-md-8 col-md-offset-2">




            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

            </div>
        </div> -->