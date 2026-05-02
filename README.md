# Pokédex API PHP

Projeto desenvolvido para a disciplina de Programacao para Internet I, com o objetivo de consumir dados de uma API externa utilizando PHP, HTML, CSS e JavaScript.

A aplicação utiliza a [PokeAPI](https://pokeapi.co/) para buscar informações sobre Pokémon e exibir os dados de forma simples e organizada na tela.

## Objetivo do Projeto

O objetivo principal do projeto é demonstrar o consumo de uma API externa através de um arquivo PHP responsável por buscar os dados, tratar as informações recebidas em JSON e enviá-las para o front-end.

O projeto também conta com páginas HTML separadas, estilização própria com CSS e uso de JavaScript para carregar os dados dinamicamente na tela.

## Funcionalidades

O projeto possui três páginas principais:

### Página Inicial

A página inicial apresenta dois cards principais para navegação:

- Buscar Pokémon por nome
- Buscar Pokémon por tipo

Cada card possui uma imagem, uma breve descrição e um botão de acesso para a funcionalidade correspondente.

### Buscar Pokémon por Nome

Nesta página, o usuário pode digitar o nome de um Pokémon e buscar suas informações na API.

Exemplo de busca:

```text
pikachu
charizard
ditto
```

Após a busca, são exibidos dados como:

- Nome do Pokémon
- ID
- Altura
- Peso
- Imagem
- Tipos
- Habilidades

Caso o Pokémon não seja encontrado ou ocorra algum problema na busca, uma mensagem de erro é exibida para o usuário.

### Buscar Pokémon por Tipo

Nesta página, o usuário pode selecionar um tipo de Pokémon em um menu suspenso.

Exemplos de tipos disponíveis:

```text
fire
water
grass
electric
dragon
fairy
```

Após selecionar um tipo, a aplicação lista Pokémon pertencentes àquele tipo.

Os resultados são exibidos em formato de cards, contendo:

- Imagem
- Nome
- ID

A página também possui paginação, permitindo navegar entre os resultados sem exibir todos os Pokémon de uma vez.

## Paginação

A busca por tipo utiliza um sistema simples de paginação.

Em vez de mostrar todos os Pokémon de um tipo de uma vez, a aplicação mostra apenas uma quantidade limitada por página.

Exemplo:

```text
Página 1: Pokémon 1 até 20
Página 2: Pokémon 21 até 40
Página 3: Pokémon 41 até 60
```

A URL usada para buscar a segunda página de Pokémon do tipo água, por exemplo, fica assim:

```text
api.php?tipo=water&page=2&limit=20
```

Esse sistema deixa a visualização mais organizada e evita carregar uma lista muito grande de uma vez na tela.

## Estrutura do Projeto

A estrutura principal do projeto é:

```text
pokedex-api-php/
|└──projeto-api/     
|   ├── api.php      
|   ├── buscar_pokemon.html 
|   ├── buscar_tipos.html     
|   ├── card1.jpg   
|   ├── card2.jpg
|   ├── card2.png
|   ├── index.html  
|   └── style.css      
└── README.md 
```

## Descrição dos Arquivos

### `index.html`

Página inicial do projeto.

Contém dois cards principais, permitindo que o usuário escolha entre buscar um Pokémon pelo nome ou buscar Pokémon por tipo.

### `buscar_pokemon.html`

Página responsável pela busca de Pokémon pelo nome.

Ela possui um formulário simples onde o usuário digita o nome do Pokémon. O JavaScript envia esse nome para o arquivo `api.php`, recebe os dados em JSON e exibe as informações na tela.

### `buscar_tipos.html`

Página responsável pela busca de Pokémon por tipo.

Possui um menu de seleção com os tipos disponíveis. Após escolher um tipo, o JavaScript consulta o `api.php`, recebe uma lista de Pokémon daquele tipo e exibe os resultados em cards.

Também possui botões de paginação para navegar entre os resultados.

### `style.css`

Arquivo responsável pela estilização do projeto.

Inclui:

- Layout centralizado
- Estilização dos formulários
- Cards dos Pokémon
- Cards da página inicial
- Responsividade para telas menores
- Animações simples com CSS
- Estilização da paginação

### `api.php`

Arquivo responsável por consumir a PokeAPI.

Ele funciona como uma ponte entre o front-end e a API externa.

O arquivo aceita dois tipos principais de requisição:

#### Buscar Pokémon por nome

Exemplo:

```text
api.php?pokemon=pikachu
```

Essa busca consome o endpoint:

```text
https://pokeapi.co/api/v2/pokemon/pikachu
```

E retorna os dados formatados em JSON para o JavaScript.

#### Buscar Pokémon por tipo

Exemplo:

```text
api.php?tipo=fire&page=1&limit=20
```

Essa busca consome o endpoint:

```text
https://pokeapi.co/api/v2/type/fire
```

Depois disso, o PHP organiza os dados, aplica a paginação e retorna apenas os Pokémon daquela página.

## Tecnologias Utilizadas

- HTML5
- CSS3
- JavaScript
- PHP
- JSON
- PokeAPI

## Como Executar o Projeto

Use um servidor PHP(ou o "api.php" não vai ser processado).

Dentro da pasta do projeto, execute:

```bash
php -S localhost:8000
```

Depois, abra no navegador:

```text
http://localhost:8000
```

## Exemplos de Uso

### Buscar Pokémon por Nome

1. Acesse a página **Buscar Pokémon**.
2. Digite o nome de um Pokémon.
3. Clique em buscar.
4. Os dados serão exibidos na tela.

Exemplo:

```text
pikachu
```

### Buscar Pokémon por Tipo

1. Acesse a página **Buscar por Tipo**.
2. Escolha um tipo no menu.
3. Clique em buscar.
4. Os Pokémon daquele tipo serão exibidos em cards.
5. Use os botões de paginação para navegar entre os resultados.

Exemplo:

```text
fire
```

## Tratamento de Erros

O projeto possui tratamento básico de erros.

Alguns exemplos:

- Caso o usuário tente buscar sem preencher o campo.
- Caso o Pokémon não seja encontrado.
- Caso o tipo escolhido não retorne dados corretamente.
- Caso ocorra erro ao acessar a API.
- Caso os dados JSON não sejam convertidos corretamente.

Quando algum erro acontece, uma mensagem é exibida para o usuário.

## Responsividade

O layout foi feito para funcionar tanto em telas de computador quanto em telas menores, como celulares.

Foram utilizados recursos como:

- `flex`
- `grid`
- `media queries`
- largura máxima para containers
- cards ajustáveis

