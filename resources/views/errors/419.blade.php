  @extends('errors::minimal')

@section('title', __('Page Expired'))
 @section('code', '419')
@section('message', __('Page Expired')) 
@extends('errors::minimal') 


 
<!doctype html>
<html>
<head>
<title>Page Expired</title>
<meta charset="utf-8"/>
<meta name="robots" content="noindex"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
  body { text-align: center; padding: 15%; }
  h1 { font-size: 50px; }
  body { font: 20px Helvetica, sans-serif; color: #333; }
  article { display: block; text-align: left; width: 70%; margin: 0 auto; }
  a { color: #dc8100; text-decoration: none; }
  a:hover { color: #333; text-decoration: none; }
</style>
</head>
<body>
<article>
    <h1>Page Expired</h1>
    <div>
        <p class="title">Sorry, your session has expired.  </p>
        <a href="{{ url('/home') }}"><p>GO HOME</p></a>
    </div>

</article>
</body>
</html> 