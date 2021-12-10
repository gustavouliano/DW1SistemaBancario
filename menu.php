<!DOCTYPE HTML>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<title>Sistema Bancário</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="estiloteste.css" rel="stylesheet">
</head>
<script>
	var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
	var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
		return new bootstrap.Dropdown(dropdownToggleEl)
	})
</script>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">Página Inicial</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Cadastrar
						</a>
						<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
							<li><a class="dropdown-item" href="cadCliente.php">Cliente</a></li>
							<li><a class="dropdown-item" href="cadTipo.php">Tipo de operação</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Consultar
						</a>
						<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
							<li><a class="dropdown-item" href="clienteLista.php">Cliente</a></li>
							<li><a class="dropdown-item" href="tipoLista.php">Tipo de operação</a></li>
							<li><a class="dropdown-item" href="contaLista.php">Conta</a></li>
							<li><a class="dropdown-item" href="operacaoLista.php">Operação</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="cadConta.php">Nova Conta</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="cadOperacao.php">Nova Operação</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- <nav>
		<ul class="menu">
			<li><a href="index.php">Início</a></li>
			<li><a href="#">Cadastros</a>
				<ul>
					<li><a href="cadCliente.php">Cliente</a></li>
					<li><a href="cadTipo.php">Tipo Operação</a></li>
				</ul>
			</li>
			<li><a href="#">Consultas</a>
				<ul>
					<li><a href="clienteLista.php">Cliente</a></li>
					<li><a href="tipoLista.php">Tipo de operação</a></li>
					<li><a href="contaLista.php">Conta</a></li>
					<li><a href="operacaoLista.php">Operação</a></li>
				</ul>
			</li>
			<li><a href="cadConta.php">Conta</a></li>
			<li><a href="cadOperacao.php">Nova operação</a></li>
		</ul>
	</nav> -->
	<br>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>