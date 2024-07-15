<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Consulta de CEP</title>

<style>

    body {
        background-color: black;
        background-size: cover;
        background-position: center;
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
    }
    .container {
    
        width: 30%;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    form {
        display: flex;
        flex-direction: column;
    }
    label, input, button {
        margin-bottom: 10px;
    }
    input, button {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        background-color: #007BFF;
        color: white;
        cursor: pointer;
        border: none;
    }
    button:hover {
        background-color: #0056b3;
    }
</style>

</head>
<body>
    <div class="container">
        <h1>Dados do Endereço</h1>
        <?php
        if (isset($_POST['cep'])) {
            $cep = $_POST['cep'];
        }

        if (isset($cep) && strlen($cep) === 8) {
            $url = "https://viacep.com.br/ws/" . $cep . "/json/";
            $json = file_get_contents($url);
            $json_data = json_decode($json, true);
        }
        ?>
        <form method="post">
            <label for="cep">Insira seu CEP:</label>
            <input type="text" name="cep" class="cep" value="<?php if (isset($json_data)) echo $json_data['cep']; ?>" id="cep">
            <button type="submit">Pesquisar</button>

            <label for="logradouro">Logradouro:</label>
            <input type="text" name="logradouro" value="<?php if (isset($json_data)) echo $json_data['logradouro']; ?>" id="logradouro"> 

            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" value="<?php if (isset($json_data)) echo $json_data['bairro']; ?>" id="bairro"> 

            <label for="numero">Número:</label>
            <input type="text" name="numero" id="numero"> 

            <label for="complemento">Complemento:</label>
            <input type="text" name="complemento" value="<?php if (isset($json_data) && isset($json_data['complemento'])) echo $json_data['complemento']; ?>" id="complemento"> 

            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" value="<?php if (isset($json_data)) echo $json_data['localidade']; ?>" id="cidade"> 

            <label for="uf">UF:</label>
            <input type="text" name="uf" value="<?php if (isset($json_data)) echo $json_data['uf']; ?>" id="uf"> 
        </form>
    </div>
</body>
</html>

