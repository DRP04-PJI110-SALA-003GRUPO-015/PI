document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    
    // Aqui você pode adicionar a lógica de verificação do usuário e senha
    // Por exemplo, você pode fazer uma requisição AJAX para verificar os dados no servidor
    
    if (username === 'admin' && password === 'admin') {
        // alert('Login bem-sucedido!');
            window.location.href = "menu_principal.php";
        // Aqui você pode redirecionar o usuário para outra página, por exemplo:
        // window.location.href = 'pagina-secreta.html';
    } else {
        document.getElementById('error-message').innerText = 'Usuário ou senha incorretos.';
    }
});
