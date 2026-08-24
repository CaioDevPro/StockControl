# StockControl
Sistema de Controle de Estoque - Projeto Web 2

## Como fazer o primeiro acesso

1. Mova a pasta "StockControl" para sua pasta "htdocs" do XAMPP;
2. Ative o Apache e o MySQL;
3. Acesse `http://localhost/StockControl/public/instalar.php` no navegador.

Isso vai criar o banco de dados, as tabelas e o usuário administrador padrão automaticamente.

**Obs.:** o `instalar.php` pode ser executado mais de uma vez sem problema — ele não duplica dados existentes. Mesmo assim, recomendamos apagar ou renomear esse arquivo depois de confirmar que tudo funcionou, por segurança.

## Forma alternativa de instalação (via phpMyAdmin)

Se preferir não usar o instalador automático, você pode montar o banco manualmente:

1. Abra o phpMyAdmin (`http://localhost/phpmyadmin`);
2. Clique em "SQL" no menu superior (sem selecionar nenhum banco antes);
3. Abra o arquivo `database.sql` (na raiz do projeto), copie todo o conteúdo e cole no campo SQL;
4. Clique em "Executar".

Esse script cria a mesma estrutura que o instalador automático: as 4 tabelas (`categorias`, `fornecedores`, `produtos`, `usuarios`) e o usuário administrador padrão.

## Como acessar o sistema

Depois de instalar o banco de dados (por qualquer uma das duas formas acima), acesse:

```
http://localhost/StockControl/public/
```

Você será direcionado à página inicial. Clique em "Login" e entre com as credenciais de administrador (veja abaixo) para acessar o Painel e as demais funcionalidades do sistema.

## Acesso como administrador

- **E-mail:** admin@administrativo.com
- **Senha:** Adm1n%26