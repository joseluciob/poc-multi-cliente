# Capturando o Header e Configurando a Conexão Dinâmica

O middleware `Http/Middleware/IdentifyClient.php` é responsável por capturar o identificador da aplicação a partir do header da requisição (`X-Application-ID`). Com base nesse identificador, o middleware configura uma conexão dinâmica com o banco de dados, ajustando a conexão para o banco de dados correspondente ao cliente.

Essa configuração é aplicada apenas durante o ciclo da requisição, garantindo que as conexões sejam isoladas e seguras para cada cliente.

# Testando a Conexão

O controlador `Http/Controllers/TesteController.php` realiza um teste de conexão com o banco de dados configurado dinamicamente pelo middleware e retorna informações sobre a conexão atual, juntamente com os dados obtidos da tabela.

## Testando Requisições Concorrentes

Para validar o comportamento da aplicação em cenários de requisições simultâneas, foi desenvolvido um script de teste em Python (`concurrent_requests.py`). Esse script realiza três requisições concorrentes ao endpoint `/teste`, simulando acesso simultâneo de diferentes clientes, e verifica se os dados retornados estão corretos e isolados para cada requisição.
