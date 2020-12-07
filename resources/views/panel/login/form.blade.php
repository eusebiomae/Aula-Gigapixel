
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Login - Gigapixel</title>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">



	</head>

	<body class="text-center">
		<div class="container">

			<form action="/panel/login" method="post" class="form-signin">
				@csrf

				<br><br><br><br><br>

				<div style="height: auto; align-self: center">
				<img
        {{-- alt="Giga Logo" --}}
        src="/img/logo_mini.png"
        width="100px"
        style="margin: auto"
				/>
				</div>

				<br>

				<h1 class="h3 mb-3 font-weight-normal"> Aula Gigapixel </h1>
				<br>

				<div class="form-row justify-content-md-center">

					<div class="col-center">

						<label for="Email"> Email </label>
						<input type="email" class="form-control  mb-2" id="Email" name="email" placeholder="Digite seu e-mail" required autofocus >

					</div>

					<div class="col-center">

						<label for="Password"> Senha </label>
						<input type="password" class="form-control  mb-2" id="Password" name="password" placeholder="Digite sua senha" required>

					</div>

				</div>

				<br>

				<div class="col-auto">

					<button type="submit" class="btn btn-primary mb-2"> Entrar </button>

				</div>

			</form>
		</div>


		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

	</body>
</html>





