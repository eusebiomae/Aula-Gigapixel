<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">Aula Gigapixel</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse"
			data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="/panel">Home<span class="sr-only"></span></a>
			</li> <br>

			@if (authMenu('panel.user'))

			<li class="nav-item active">
				<a class="nav-link" href="/panel/user">Usuário</a>
			</li>

			@endif

			@if (authMenu('panel.userType'))

			<li class="nav-item active">
				<a class="nav-link" href="/panel/user_type">Tipo de Usuário</a>
			</li>

			@endif

			<li class="nav-item active">
				<a class="nav-link" href="/panel/login/logout">Logout</a>
			</li>
    </ul>
  </div>
				<span class="navbar-text">
					<a class href="/panel/user/update/ {{Auth::user()->id}}">
					<h3> {{Auth::user()->name}} </h3>
					</a>
				</span>
</nav>

