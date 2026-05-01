<?php

header('Content-Type: application/json; charset=utf-8');

$pokemon = $_GET['pokemon'] ?? '';
$tipoBusca = $_GET['tipo'] ?? '';

$pokemon = strtolower(trim($pokemon));
$tipoBusca = strtolower(trim($tipoBusca));

$contexto = stream_context_create([
    'http' => [
        'method' => 'GET',
        'timeout' => 20
    ]
]);

// BUSCA POKEMON POR NOME 
if ($pokemon !== '') {
    $url = "https://pokeapi.co/api/v2/pokemon/" . urlencode($pokemon);

    $resposta = @file_get_contents($url, false, $contexto);

    if ($resposta === false) {
        http_response_code(404);

        echo json_encode([
            'erro' => true,
            'mensagem' => 'Pokemon não encontrado ou erro ao acessar a API.'
        ]);

        exit;
    }

    $dados = json_decode($resposta, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(500);

        echo json_encode([
            'erro' => true,
            'mensagem' => 'Erro ao converter os dados da API.'
        ]);

        exit;
    }

    $tipos = [];

    foreach ($dados['types'] as $tipo) {
        $tipos[] = $tipo['type']['name'];
    }

    $habilidades = [];

    foreach ($dados['abilities'] as $habilidade) {
        $habilidades[] = $habilidade['ability']['name'];
    }

    echo json_encode([
        'erro' => false,
        'id' => $dados['id'],
        'nome' => $dados['name'],
        'altura' => $dados['height'],
        'peso' => $dados['weight'],
        'imagem' => $dados['sprites']['front_default'],
        'tipos' => $tipos,
        'habilidades' => $habilidades
    ]);

    exit;
}

// BUSCA POKEMON POR TIPO 
if ($tipoBusca !== '') {
    $pagina = $_GET['page'] ?? 1;
    $limite = $_GET['limit'] ?? 20;

    $pagina = intval($pagina);
    $limite = intval($limite);

    if ($pagina < 1) {
        $pagina = 1;
    }

    if ($limite < 1) {
        $limite = 20;
    }

    $url = "https://pokeapi.co/api/v2/type/" . urlencode($tipoBusca);

    $resposta = @file_get_contents($url, false, $contexto);

    if ($resposta === false) {
        http_response_code(404);

        echo json_encode([
            'erro' => true,
            'mensagem' => 'Tipo não encontrado ou erro ao acessar a API.'
        ]);

        exit;
    }

    $dados = json_decode($resposta, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(500);

        echo json_encode([
            'erro' => true,
            'mensagem' => 'Erro ao converter os dados da API.'
        ]);

        exit;
    }

    $total = count($dados['pokemon']);
    $totalPaginas = ceil($total / $limite);

    $inicio = ($pagina - 1) * $limite;

    $lista = array_slice($dados['pokemon'], $inicio, $limite);

    $pokemons = [];

    foreach ($lista as $item) {
        $nome = $item['pokemon']['name'];
        $urlPokemon = $item['pokemon']['url'];

        $partes = explode('/', trim($urlPokemon, '/'));
        $id = end($partes);

        $imagem = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/" . $id . ".png";

        $pokemons[] = [
            'id' => $id,
            'nome' => $nome,
            'imagem' => $imagem
        ];
    }

    echo json_encode([
        'erro' => false,
        'tipo' => $tipoBusca,
        'pagina' => $pagina,
        'limite' => $limite,
        'total' => $total,
        'totalPaginas' => $totalPaginas,
        'pokemons' => $pokemons
    ]);

    exit;
}

// SE NÃO VEIO NEM POKEMON NEM TIPO 
http_response_code(400);

echo json_encode([
    'erro' => true,
    'mensagem' => 'Informe um Pokemon ou um tipo para buscar.'
]);

?>