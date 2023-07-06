Guia de Uso do Software

Este guia fornece instruções passo a passo para utilizar o software corretamente. Siga as etapas abaixo:
1. Iniciando o Servidor Local

Para iniciar o servidor local, execute o seguinte comando:

php artisan serve

Isso iniciará o servidor local e permitirá que você acesse o aplicativo em seu navegador por meio da URL fornecida.
2. Migração do Banco de Dados

Para criar as tabelas necessárias no banco de dados, execute o seguinte comando de migração:

php artisan migrate

Isso garantirá que as tabelas estejam devidamente configuradas de acordo com as definições dos modelos.
3. Povoando o Banco de Dados

Para adicionar dados de exemplo ao banco de dados, execute o seguinte comando de seed:

php artisan db:seed

Isso criará registros de exemplo nas tabelas do banco de dados para uso durante o desenvolvimento e teste. Durante o processo de seed, um usuário administrador será gerado. Verifique os logs para obter as informações de login desse usuário.

    Observação: Certifique-se de que sua configuração de conexão com o banco de dados esteja correta no arquivo .env. Verifique se as informações de host, nome do banco de dados, usuário e senha estão configuradas corretamente.

4. Execução da Fila de E-mails

Para garantir que os e-mails sejam enviados corretamente, é necessário executar a fila de trabalhos (jobs) relacionados aos e-mails. Execute o seguinte comando:

arduino

php artisan queue:work --tries=3

Isso iniciará o processo de execução da fila de trabalhos, permitindo que os e-mails sejam processados e enviados.
Estrutura dos Testes

Os testes foram organizados seguindo a estrutura de diretórios do aplicativo. Certifique-se de que os testes estejam localizados no diretório tests/App.
Limpeza do Banco de Dados para Testes

Antes de executar os testes, é recomendável limpar o banco de dados para evitar duplicação de informações. Você pode fazer isso executando o seguinte comando:

php artisan migrate:refresh

Isso recriará as tabelas do banco de dados, garantindo um ambiente de teste limpo.
Execução dos Testes

Execute os testes individuais conforme necessário, utilizando os comandos abaixo:

    Teste de envio de e-mail:

    bash

php artisan test --filter=sendEmailControllerTest

Testes do serviço de orçamento:

bash

php artisan test --filter=BudgetServiceTest

Testes do controlador de administração de orçamento:

bash

php artisan test --filter=BudgetAdminControllerTest

Testes do controlador de registro de orçamento:

bash

php artisan test --filter=BudgetRegistrationControllerTest

Testes de edição de orçamento:

bash

php artisan test --filter=BudgetRegistrationEditionTest

Testes de registro simplificado de orçamento:

bash

php artisan test --filter=BudgetRegistrationSimplyTest

Testes de armazenamento de orçamento:

bash

php artisan test --filter=BudgetRegistrationStoreTest

Testes do serviço deadministração de orçamento:

bash

    php artisan test --filter=BudgetAdminServiceTest

Certifique-se de executar os testes individualmente conforme necessário e verificar se não há erros ou exceções durante a execução do aplicativo.

Com essas etapas concluídas, você estará pronto para utilizar o software corretamente. Siga as instruções cuidadosamente e verifique se todas as etapas são executadas com sucesso.