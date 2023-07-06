## Guia de Uso do Software

Este é um guia para ajudar você a utilizar o software corretamente. Siga as etapas abaixo:

### 1. Iniciando o servidor local

Execute o seguinte comando para iniciar o servidor local:

```
php artisan serve
```

Isso iniciará o servidor local e você poderá acessar o aplicativo em seu navegador usando o URL fornecido.

### 2. Migração do Banco de Dados

Execute o seguinte comando para migrar as tabelas do banco de dados:

```
php artisan migrate
```

Isso criará as tabelas necessárias no banco de dados de acordo com as definições dos modelos.

### 3. Povoando o Banco de Dados

Execute o seguinte comando para popular o banco de dados com dados de exemplo:

```
php artisan db:seed
```

Isso criará registros de exemplo nas tabelas do banco de dados para uso durante o desenvolvimento e teste.

> **Observação**: Após a execução deste comando, será gerado um usuário administrador. Verifique os logs para obter as informações de login desse usuário.

### 4. Validação da Conexão com o Banco de Dados

Certifique-se de que sua configuração de conexão com o banco de dados esteja correta no arquivo `.env`. Verifique se as informações do host, nome do banco de dados, usuário e senha estão corretamente configuradas.

### 5. Execução da Fila de E-mails

Para que os e-mails sejam enviados corretamente, você precisa executar a fila de trabalhos (jobs) relacionada aos e-mails. Execute o seguinte comando:

```
php artisan queue:work --tries=3
```

Isso iniciará o processo de execução da fila de trabalhos, permitindo que os e-mails sejam processados e enviados.

### Estrutura dos Testes

Os testes foram organizados seguindo a estrutura de diretórios do aplicativo. Certifique-se de que os testes estejam localizados no diretório `tests/App`.

### Armazenamento de Dados

Os dados de registro estão sendo armazenados em um banco de dados chamado `user_project_budget_types`, que possui relacionamentos com as tabelas `types` e `user_project_budgets`. Verifique a estrutura dessas tabelas no banco de dados para entender como os dados estão sendo armazenados e relacionados.

Com essas etapas concluídas, você estará pronto para utilizar o software corretamente. Certifique-se de seguir todas as instruções e verificar se não há erros ou exceções durante a execução do aplicativo.

#### Teste


para melhor confiabilidade limpe o banco de dados para fazer os teste
command php artisan migrate:refresh

# php artisan test --filter=sendEmailControllerTest
# php artisan test --filter=BudgetServiceTest 
# php artisan test --filter=BudgetAdminControllerTest
# php artisan test --filter=BudgetRegistrationControllerTest
# php artisan test --filter=BudgetRegistrationEditionTest
# php artisan test --filter=BudgetRegistrationSimplyTest
# php artisan test --filter=BudgetRegistrationStoreTest
# php artisan test --filter=BudgetAdminServiceTest



