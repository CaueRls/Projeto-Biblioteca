*(Isso diz ao Railway: "Use o Apache e aponte a raiz do site para a pasta `public/`".)*

---

### 2. Variáveis de Ambiente (O Segredo da Produção)
No seu computador, você usa o arquivo `.env`. No Railway, você **não sobe** esse arquivo (ele fica no `.gitignore` por segurança).

Lá no painel do Railway, você vai criar as variáveis manualmente na aba "Variables". As principais que você vai precisar configurar lá são:

* `APP_ENV` = `production`
* `APP_KEY` = *(Copie a chave do seu .env local)*
* `APP_DEBUG` = `false` *(Importante para segurança!)*
* `APP_URL` = *(O endereço https://... que o Railway vai te dar)*
* **Banco de Dados:** O Railway cria o banco para você e te dá uma variável chamada `DATABASE_URL`. O Laravel entende isso nativamente se a configuração estiver certa (ver passo 3).

---

### 3. Configuração de Banco de Dados (PostgreSQL)
O Railway usa **PostgreSQL** ou **MySQL**. Se você optar pelo PostgreSQL (que é excelente e padrão lá), certifique-se de que seu arquivo `config/database.php` já está preparado para ler a variável `DATABASE_URL`.

No Laravel moderno, isso já vem pronto, mas é bom garantir que no seu `config/database.php` a conexão `pgsql` esteja assim:

```php
'pgsql' => [
    'driver' => 'pgsql',
    'url' => env('DATABASE_URL'), // <--- O Railway usa isso
    'host' => env('DB_HOST', '127.0.0.1'),
    // ... resto das configs
],
