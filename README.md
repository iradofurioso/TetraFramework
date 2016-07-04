# Tetra Framework

O Tetra Framework é uma estrutura simples para projetos pequenos. O objetivo primordial do Tetra Framework é possibilitar a aplicação e uso dos 
novos recursos disponíveis nas novas versões do PHP. Aliado ao objetivo inicial, o Tetra Framework utiliza módulos de grandes frameworks como o 
Symfony, Zend, CodeIgniter ou Laravel. Os componentes tanto próprios quanto de terceiros, assim como definição do autoload entre outras ações devem 
ser gerenciados através do Composer. No momento em estágio inicial e não está 100% funcional ainda.

## Requisitos

Apache >= 2 

PHP >= 5.3.2

### Instalação

A instalação é muito simples. Você deve editar os arquivos .htaccess e o arquivo config.development.json e quando colocar em produção editar também 
o arquivo config.production.json. No arquivo .htaccess você vai editar as seguintes linhas: 

```
SetEnv APPLICATION_ENV "development"

SetEnv SECURED_FOLDER_PATH "../../priv"
```

Na primeira linha você vai definir o ambiente que o TetraFramework está rodando. Na segunda linha você deve difinir o local exato de está localizado 
o diretório priv. Por razões de segurança você deve colocar o diretório priv sempre acima / fora da pasta public_html ou www. Deste modo o diretório 
priv ficará fora de um local públic. É interessante colocar permissões de leitura e escrita da pasta somente para o usuário dono do projeto assim como 
o usuário ou grupo do Apache. 

### Testando 

Depois de configurado para testar é só acessar a aplicação padrão no navegador (assumindo que o endereço do seu apache seja localhost): 

```
http://localhost/ola
```

## Componentes do Symfony já Disponíveis por Padrão 

* [HttpFoundation](http://symfony.com/doc/current/components/http_foundation/index.html) - Este componente cria uma camada orientada a objetos para as especificações HTTP.

* [Routing](http://symfony.com/doc/current/components/routing/introduction.html) - Faz o mapeamento das requisições HTTP.

## Licença

Este projeto está licenciado de acordo com o MIT License - veja mais em [LICENSE.md](LICENSE.md) para maiores detalhes.
