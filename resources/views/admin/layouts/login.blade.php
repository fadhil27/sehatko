<!DOCTYPE html>
<html>

<head>
<title>Login Admin SEHATKO</title>
<link rel="icon" type="image/png" href="{{ asset('/storage/web_assets/sehatkologo.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content=" Master  Login Form Widget Tab Form,Login Forms,Sign up Forms,Registration Forms,News letter Forms,Elements"/>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="{{asset('css/login.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=Cormorant+SC:300,400,500,600,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
	<div class="padding-all">
		<div class="header">
			<h1>Login Admin SEHATKO</h1>
		</div>

        
		<div class="design-w3l">
            <div class="mail-form-agile">
                @if ($message = Session::get('error'))
                <p class="text-danger auto-mx" >{{ $message }}</p>
                @endif
                <form action="/login/submit" method="post">
                    @csrf
                    <input type="text" name="username" placeholder="Username" required=""/>
                    @error('username') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                    <input type="password"  name="password" class="padding" placeholder="Password" required=""/>
                    @error('password') <span class="text-danger text-xs">{{ $message }}</span> @enderror
					<button type="submit" class="btn btn-info" value="login">Login</button>
				</form>
			</div>
		<div class="clear"> </div>
		</div>
		
		<div class="footer">
		<p><a href="#" >  SEHATKO </a></p>
		</div>
	</div>
</body>
</html>