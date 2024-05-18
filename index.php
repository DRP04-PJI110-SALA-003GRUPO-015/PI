<!DOCTYPE html>
<html>
<head>
    <title>PI1 - SUPER TROCA DE ÓLEO</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
        /* CSS Personalizado */
        .custom-button {
            background-color: #274e77;
            border-color: #274e77;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        /* Efeito hover */
        .custom-button:hover {
            background-color: #1a3550;
            border-color: #1a3550;
        }
    </style>
</head>
<body>
    <div class="login-container">
		<h5>SUPER TROCA DE ÓLEO</h5> <br>
        <h6>Versão 2.1 - 13/05/2024</h6> <br>
    	<h5>Identifique-se para</h5>
        <h5>acessar o sistema</h5>
        <h2 class="car-icon"><i class="fas fa-car"></i></h2>
        <form id="login-form" action="validar_login.php" method="post">    
            <div class="input-container">
                <input type="text" id="username" name="username" placeholder="Usuário" required>
            </div>
            <div class="input-container">
                <input type="password" id="password" name="password" maxlength=6 placeholder="Senha" required>
            </div>
            <button type="submit" class="custom-button"><i class="fas fa-sign-in-alt"></i> Entrar</button>
        </form>
        <div id="error-message"></div>
        <a href="menu_principal.php">Acessar o sistema</a><br><a><h6>(acesso temporário)</h6></a>
    </div>    
</body>
</html>
