<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>PI1 - SUPER TROCA DE ÓLEO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="geral.css">

	<style>
	.container {
	margin-bottom: 20px;
	}


	.nav {
		margin-top: 5px;
		margin-bottom: 20px;
	}


	</style>

</head>

<body>
    <div class="container mt-4">
        <header class="text-center mb-4">
            <div class="container">
                <h1>SUPER TROCA DE ÓLEO</h1>
                <h2>Relatórios</h2>
                <nav>
                    <a href="menu_principal.php">Retorna 'Menu principal'</a>
                </nav>
            </div>
        </header>
        <div class="container">
			<header class="text-center mb-4">
				<h2 class = "text-center">Relatórios Cadastrais</h2>
			</header>
            <nav class="nav justify-content-center">
                <div class="container">
                    <div class="col-md-4">
                        <a href="relatorio_usuarios.php">Usuários</a>
                    </div>
                    <div class="col-md-4">
                        <a href="relatorio_clientes.php">Clientes</a>
                    </div>
                    <div class="col-md-4">
                        <a href="relatorio_veiculos.php">Veículos</a>
                    </div>
                    <div class="col-md-4">
                        <a href="relatorio_ordens_geral.php">Ordens de serviço - geral</a>
                    </div>
                    <div class="col-md-4">
                        <a href="relatorio_ordens_abertas.php">Ordens de serviço - abertas</a>
                    </div>
                    <div class="col-md-4">
                        <a href="relatorio_ordens_fechadas.php">Ordens de serviço - fechadas</a>
                    </div>
                    <div class="col-md-4">
                        <a href="relatorio_ordens_canceladas.php">Ordens de serviço - canceladas</a>
                    </div>
                </div>
			</nav>

			<header class="text-center mb-4">
				<h2 class = "text-center">Relatórios Gerenciais</h2>
			</header>

			<nav class="nav justify-content-center">
                <div class="container">
                    <div class="col-md-4">
                        <a href="">Clientes - última visita</a>
                    </div>
                    <div class="col-md-4">
                        <a href="">Clientes fiéis - promoção</a>
                    </div>
                    <div class="col-md-4">
                        <a href="">Veículos - próxima troca</a>
                    </div>
                </div>
			</nav>	
            
        </div>
    </div>

    <!-- BOOTSTRAP JS, POPPER.JS, AND JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlO0bTQp+9eLQELHj6V3LBjYd2ZzldC1vM3Q1/cQ3zof2K2f+V4Hj4Kq4EX" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha384-w1Qj7qf/5bNerAU8+K6d4E4oV2PLWlrW1AVpaOBlBDddWhYUGQ35aeawFslKwPp0" crossorigin="anonymous"></script>
</body>
</html>
