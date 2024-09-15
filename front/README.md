# Configurando a Aplicação Frontend para Lidar com Múltiplos Subdomínios

## Obtendo o Identificador pelo Subdomínio

O arquivo `src/app/core/services/subdomain.service.ts` é responsável por obter o nome da aplicação que está sendo acessada via subdomínio.

Por exemplo, se a URL for `app1.locaauto.com.br`, este serviço captura o `app1`.

## Injetando o Header de Identificação

O arquivo `src/app/core/interceptors/subdomain.interceptor.ts` é responsável por interceptar todas as requisições e adicionar um header identificador da aplicação chamado `X-Application`.

### Exemplo de uma Requisição GET:

```plaintext
GET /resource HTTP/1.1
Host: app1.locaauto.com.br
X-Application: app1
```

### Exemplo de uma Requisição POST:
```plaintext
POST /resource HTTP/1.1
Host: app1.locaauto.com.br
Content-Type: application/json
X-Application: app1

{
  "data": "some data",
  "application": "app1"
}
```


# Configuração do Route 53 e CloudFront

### 1. Configuração do Route 53

1. **Criar Zona Hospedada**
   - Acesse o Route 53
   - Vá para **Hosted zones** e clique em **Create hosted zone**.
   - Insira o domínio `locaauto.com.br` e clique em **Create**.
   - Atualize os servidores DNS no registrador do seu domínio com os Name Servers fornecidos.

2. **Adicionar Registro CNAME**
   - Na zona hospedada, clique em **Create record**.
   - Tipo: `CNAME`.
   - **Record name**: `*` (para subdomínios).
   - **Route traffic to**: Escolha **Alias to CloudFront distribution** e selecione a distribuição.

### 2. Configuração do CloudFront

1. **Criar Distribuição CloudFront**
   - Acesse o AWS CloudFront
   - Clique em **Create Distribution** > **Web**.
   - **Origin Domain Name**: Selecione o bucket S3 ou servidor que hospeda a aplicação Angular.

2. **Configurar CNAMEs**
   - Em **Settings**, adicione `*.locaauto.com.br` em **Alternate Domain Names (CNAMEs)**.

3. **Certificado SSL/TLS**
   - Em **Custom SSL Certificate**, selecione um certificado que cubra `*.locaauto.com.br` via AWS Certificate Manager (ACM).
