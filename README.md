# Music Metadata Provider

Processo Seletivo para a equipe de Backend do produto Claro Música.

## Introdução

Este teste tem como objetivo avaliar as habilidades do candidato para o manejo de aplicações Backend e suas atividades corriqueiras: bugfix, novas funcionalidades, melhorias de performance e evolução.

A camada de APIs Music Metadata Provider tem como objetivo atuar como wrapper das APIs Last.fm (https://www.last.fm/api) executando chamadas e encapsulando lógicas e melhorias.

## Avaliação

O candidato deverá fazer o download do projeto em https://github.com/luizjanela-imusica/music-metadata-provider, instalar e configurar em sua máquina para efetuar os passos necessários para a conclusão do teste.

Em termos técnicos o Music Metadata Provider é uma aplicação **PHP 8** que se utiliza do framework **Code Igniter v4.1.3**.

O candidato deverá seguir o padrão já desenvolvido na API album/search e demais classes internas (Models, Dal, Library etc) no desenvolvimento do teste.

## Questões

Abaixo seguem as demandas que deverão ser aplicadas nas APIs e em um segundo momento apresentadas para code review com os avaliadores do processo:

* Gerar nova API Key junto a Last.fm para configurar no projeto
* API album/search retorna apenas 1 elemento
* Na API album/search validar o parâmetro value para não aceitar input vazio retornando o code HTTP_CODE_PARAM_ERROR em caso de erro
* Na resposta da API album/search o atributo cover está retornando null
* Desenvolver nova API GET chamada artist/details
* Desenvolver nova API GET chamada chart/top onde deverá ser retornado os 5 artistas mais populares juntamente com seu álbum mais popular

Seguem abaixo duas questões bônus que podem servir como diferencial para o candidato.

**Questão bônus básica**
* A API album/search não aceita busca por termos com mais uma palavra. Exemplo: "Moving Pictures", "Hybrid Theory" etc. Adaptar a Library e Controller para corrigir esse cenário.

**Questão bônus avançada**
* Para a API chart/top deverá ser implementado cache de 1h do resultado visando melhorar o tempo de resposta.

## Entrega do Teste

O candidato deverá apresentar em call com os avaliadores as soluções aplicadas e também documentar os novos serviços desenvolvidos apresentando seus endpoints e responses.

O candidato deverá efetuar o upload do teste em sua conta do Github e enviar para os avaliadores o link para análise do material produzido.

## Material de Apoio

Seguem alguns links que ajudarão o candidato na execução do teste:

* https://codeigniter.com/user_guide/index.html
* https://codeigniter4.github.io/userguide/installation/running.html
* https://www.last.fm/api


## ALTERAÇÕES - WERNECK
Url's utilizadas no projeto

* artist/details/red (ARTISTA)
* album/search/red (ALBUM)
* chart/top (CHART)



