<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Consulta de CEP</title>

<style>
    body {
        background-color: #F6C90E;
        background-position: center; 
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        background-color: black; 
        color: white; 
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
        max-width: 600px;
        width: 100%;
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 1px solid white; 
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #333; 
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Dados do Endereço</h1>
        <?php

        $cep = "65015350";
        $curl = curl_init();
        $url = "https://viacep.com.br/ws/{$cep}/json/";

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "<p>cURL Error #:" . $err . "</p>";
        } else {
            $endereco = json_decode($response, true);

            if (array_key_exists('erro', $endereco)) {
                echo "<p>CEP não encontrado.</p>";
            } else {
                echo "<table>";
                echo "<tr><th>Informação</th><th>Dado</th></tr>";
                echo "<tr><td>CEP</td><td>" . $endereco['cep'] . "</td></tr>";
                echo "<tr><td>Logradouro</td><td>" . $endereco['logradouro'] . "</td></tr>";
                echo "<tr><td>Bairro</td><td>" . $endereco['bairro'] . "</td></tr>";
                echo "<tr><td>Localidade</td><td>" . $endereco['localidade'] . "</td></tr>";
                echo "<tr><td>UF</td><td>" . $endereco['uf'] . "</td></tr>";
                echo "<tr><td>IBGE</td><td>" . $endereco['ibge'] . "</td></tr>";
                echo "<tr><td>DDD</td><td>" . $endereco['ddd'] . "</td></tr>";
                echo "</table>";
            }
        }
        ?>
    </div>
</body>
</html>
