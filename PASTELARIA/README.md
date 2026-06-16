# Sistema de Gestão Comercial e PDV - L'Art du Pastel

---

## 1. Descrição do Projeto

O L'Art du Pastel foi desenvolvido especificamente para gerenciar as operações diárias de uma pastelaria gourmet. 

o sistema adota uma arquitetura estruturada em PHP integrada ao banco de dados relacional PostgreSQL. A aplicação centraliza o fluxo de autenticação de funcionários, gerenciamento cadastral de clientes, manutenção do catálogo de produtos e a criação transacional de pedidos em lote.

---

## 2. Objetivos do Sistema

* **Centralização Operacional:** Permitir que o atendente realize cadastros e lance pedidos a partir de um único painel integrado, sem necessidade de navegar por múltiplos sistemas externos.
* **Segurança e Consistência de Dados:** Garantir o armazenamento seguro de informações sensíveis (como senhas criptografadas) e a consistência financeira dos pedidos usando transações atómicas.
* **Experiência do Usuário (UX/UI):** Fornecer uma interface altamente responsiva e fluida baseada em manipulação dinâmica do DOM via JavaScript e janelas modais, reduzindo o tempo de carregamento de páginas.
* **Arquitetura Defensiva:** Implementar barreiras contra vulnerabilidades comuns da web, garantindo o tratamento nativo de falhas e proteção contra injeções de dados maliciosos.

---

## 3. Requisitos do Sistema

| Componente | Versão Mínima Recomendada | Finalidade no Ecossistema |
| :--- | :--- | :--- |
| Servidor Web | Apache 2.4 / Nginx | Hospedagem local e processamento de requisições HTTP. |
| Linguagem | PHP 8.0 | Processamento lógico do backend e regras de negócio. |
| Banco de Dados | PostgreSQL 13 | SGBD relacional responsável pela persistência dos dados. |
| Driver PHP | PDO_PGSQL ativado | Abstração de banco de dados para comunicação segura via PDO. |

---

## 4. Estrutura e Explicação do Banco de Dados

O banco de dados é composto por 5 tabelas estritamente relacionadas por chaves estrangeiras (Foreign Keys). Esta modelagem impede a ocorrência de dados órfãos, como a exclusão de um cliente que possui um histórico de compras ativo.

### Tabela: usuarios
Armazena os dados dos operadores do sistema autorizados a realizar vendas.
| Campo | Tipo de Dados | Chave | Atributos | Descrição |
| :--- | :--- | :--- | :--- | :--- |
| id | SERIAL | PK | NOT NULL | Identificador único do operador. |
| nome | VARCHAR(100) | | NOT NULL | Nome de usuário exclusivo para login. |
| senha | VARCHAR(255) | | NOT NULL | Hash seguro de 60+ caracteres gerado via password_hash. |

### Tabela: clientes
Registra os dados de entrega e contato dos consumidores.
| Campo | Tipo de Dados | Chave | Atributos | Descrição |
| :--- | :--- | :--- | :--- | :--- |
| id | SERIAL | PK | NOT NULL | Identificador único do cliente. |
| nome | VARCHAR(150) | | NOT NULL | Nome completo do cliente. |
| cep | VARCHAR(9) | | NOT NULL | Código postal para fins de entrega. |
| numerocasa | VARCHAR(20) | | NOT NULL | Número residencial (mapeado nos formulários). |
| telefone | VARCHAR(20) | | NOT NULL | Número de telefone para contato ou notificações. |

### Tabela: produtos
Contém o cardápio e precificação dos pastéis comercializados.
| Campo | Tipo de Dados | Chave | Atributos | Descrição |
| :--- | :--- | :--- | :--- | :--- |
| id | SERIAL | PK | NOT NULL | Identificador único do produto. |
| sabor | VARCHAR(100) | | NOT NULL | Sabor ou nome do pastel. |
| preco | NUMERIC(10,2) | | NOT NULL | Valor unitário do produto. |
| tipo | BOOLEAN | | DEFAULT TRUE | Atributo booleano necessário para regras da aplicação. |

### Tabela: status_pedidos
Tabela auxiliar que mapeia a situação atual de cada venda.
| Campo | Tipo de Dados | Chave | Atributos | Descrição |
| :--- | :--- | :--- | :--- | :--- |
| id | SERIAL | PK | NOT NULL | Identificador único do status. |
| descricao | VARCHAR(50) | | NOT NULL | Nome descritivo (ex: Pendente / Em Preparo). |

### Tabela: pedidos
Entidade central que unifica os clientes, os produtos vendidos, as quantidades e os operadores.
| Campo | Tipo de Dados | Chave | Atributos | Descrição |
| :--- | :--- | :--- | :--- | :--- |
| id | SERIAL | PK | NOT NULL | Identificador único do registro do pedido. |
| idcliente | INTEGER | FK | NOT NULL | Vínculo com a tabela de clientes. |
| idusuario | INTEGER | FK | NOT NULL | Vínculo com a tabela de usuários. |
| idprodutos | INTEGER | FK | NOT NULL | Vínculo com a tabela de produtos. |
| quantidade | INTEGER | | NOT NULL | Quantidade solicitada daquele sabor específico. |
| idstatus | INTEGER | FK | DEFAULT 1 | Vínculo com o status atual do pedido. |

---
## 5. Nome e senha de acesso
nome: Maria Clara    
senha: 123456

## 6. Mapeamento Geral dos Arquivos

| Nome do Arquivo | Módulo | Descrição Detalhada da Funcionalidade |
| :--- | :--- | :--- |
| conexao_bd.php | Core | Instancia a classe PDO com os parâmetros do PostgreSQL e define o modo de tratamento de erros. |
| index.php | Core | Roteador inicial da aplicação. Redireciona o fluxo do usuário diretamente para a tela de autenticação. |
| home.php | Core | Dashboard do Painel Executivo. Exibe métricas, atalhos de navegação macro e carrega a folha de estilos. |
| login.php | Autenticação | Interface visual de login. Utiliza técnicas visuais avançadas como Glassmorphism e efeito Parallax. |
| validar_login.php | Autenticação | Compara o input do formulário com o banco de dados utilizando a função nativa password_verify. |
| logout_login.php | Autenticação | Destrói de forma definitiva a sessão ($_SESSION) e expulsa o usuário de volta para o login. |
| cliente_read.php | Clientes | Tela integrada que exibe todos os clientes cadastrados e gerencia as janelas modais. |
| cliente_create.php | Clientes | Recebe parâmetros postados, limpa espaços vazios e persiste o cliente atribuindo o número residencial. |
| cliente_update.php | Clientes | Executa comandos de atualização UPDATE via SQL parametrizado, atualizando dados cadastrais. |
| cliente_delete.php | Clientes | Executa a remoção física de clientes, tratando restrições através de blocos try/catch. |
| validar_cliente.php | Clientes | Script auxiliar responsável pelo controle de fluxo de redirecionamentos do módulo de clientes. |
| produtos_read.php | Cardápio / PDV | Módulo de Ponto de Venda. Lista sabores de pastéis e gerencia uma Sacola de Compras interativa. |
| produtos_create.php | Produtos | Valida as entradas textuais e de valores numéricos decimais, injetando o novo item no catálogo. |
| produtos_update.php | Produtos | Processa as alterações de valores monetários e descrições dos sabores. |
| produtos_delete.php | Produtos | Deleta sabores do catálogo, emitindo avisos caso o produto esteja em uso por pedidos antigos. |
| validar_produtos.php | Produtos | Script auxiliar responsável pelo controle de fluxos do módulo de produtos. |
| pedido_create.php | Pedidos | Processa a Sacola de Compras em lote. Converte a string JSON e abre uma transação SQL (beginTransaction). |
| pedidos_delete.php | Pedidos | Remove ou cancela o registro de um pedido efetuado utilizando o identificador único ID. |
| usuario_read.php | Usuários | Interface de visualização de operadores, direcionando fluxos de permissões. |
| usuario_create.php | Usuários | Formulário para registrar novos operadores no sistema. |
| usuario_update.php | Usuários | Interface em formato carrossel horizontal para carregar dados dinamicamente nos inputs para edição. |
| usuario_delete.php | Usuários | Sistema de busca interna para localização rápida e exclusão física de funcionários cadastrados. |
| validar_create_usuario.php| Usuários | Controlador que higieniza as strings enviadas e criptografa as senhas usando password_hash. |
| validar_update_usuario.php| Usuários | Processa modificações de operadores, verificando se há necessidade de re-criptografar uma nova senha. |
| validar_delete_usuario.php| Usuários | Finaliza o comando DELETE no banco de dados para remover o operador selecionado. |
| validar_usuario.php | Usuários | Valida sessões ativas e faz a intermediação de fluxos e redirecionamentos no módulo de operadores. |


---

## 7. Escopo do Sistema

O sistema **L'Art du Pastel** engloba a automação das operações internas e de atendimento ao cliente para uma pastelaria gourmet. O ecossistema cobre desde o controle de acesso dos funcionários até a finalização e despacho das vendas no Ponto de Venda (PDV).

### O que o sistema faz (Inclusões do Escopo):
* **Autenticação Segura:** Controle de acesso restrito para operadores e atendentes através de criptografia de senhas.
* **Módulo de Clientes:** Cadastro completo (CRUD) com captura de dados de localização e contato para agilizar o fluxo de entregas.
* **Módulo de Produtos (Cardápio):** Gestão dinâmica do catálogo de sabores e precificação monetária decimal dos pastéis.
* **Módulo de Pedidos (PDV):** Interface interativa de Sacola de Compras que acumula itens em lote e processa a venda de forma transacional diretamente associada a um cliente e ao atendente logado.
* **Gestão de Operadores:** Cadastro e manutenção preventiva de novos funcionários autorizados a operar o painel executivo.

### O que o sistema NÃO faz (Exclusões do Escopo):
* **Pagamento Online:** O sistema não processa transações financeiras diretamente (cartão de crédito, PIX ou gateway de pagamento integrado). O pagamento é tratado externamente na entrega ou balcão.
* **Integração Automática de CEP (ViaCEP):** O preenchimento do código postal (CEP) é manual, não realizando requisições assíncronas automáticas para preenchimento de logradouro nesta versão.
* **Controle de Estoque de Insumos:** O sistema monitora o catálogo de produtos finais colocados à venda, mas não realiza a baixa automatizada de matérias-primas individuais (como peso de farinha ou carne por pastel).

---

## 8. Requisitos do Sistema

### 8.1. Requisitos Funcionais (RF)

Os Requisitos Funcionais descrevem as ações, comportamentos e recursos que o software deve executar para atender às necessidades operacionais do negócio.

| Identificador | Requisito Funcional | Descrição Detalhada |
| :--- | :--- | :--- |
| **RF-001** | Autenticação de Operadores | O sistema deve restringir o acesso às telas operacionais apenas a usuários cadastrados na tabela `usuarios`. |
| **RF-002** | Criptografia de Senhas | O sistema deve criptografar as senhas no momento do cadastro utilizando algoritmos hash irreversíveis (`password_hash`). |
| **RF-003** | Encerramento de Sessão | O sistema deve destruir completamente as variáveis de sessão (`$_SESSION`) quando o usuário acionar a função de logout. |
| **RF-004** | Cadastro de Clientes | O sistema deve permitir a inserção, visualização, atualização e exclusão física de clientes registrando nome, CEP, número residencial e telefone. |
| **RF-005** | Proteção contra Exclusão Órfã | O sistema deve bloquear a exclusão de clientes ou produtos que possuam vínculos ativos com o histórico de pedidos (`ON DELETE RESTRICT`). |
| **RF-006** | Manutenção do Catálogo | O sistema deve gerenciar os sabores de pastéis permitindo a alteração de nomes e de valores monetários. |
| **RF-007** | Sacola de Compras Virtual | A interface do PDV deve gerenciar dinamicamente uma sacola de compras via JavaScript que calcula o subtotal e o total em tempo real antes do envio. |
| **RF-008** | Processamento de Pedidos em Lote | O sistema deve ler a sacola estruturada em JSON e desmembrar os itens persistindo-os individualmente na tabela `pedidos`. |
| **RF-009** | Vinculação Operacional | Cada linha de pedido gerada deve registrar obrigatoriamente a chave estrangeira do cliente que compra e do usuário que efetuou a venda. |
| **RF-010** | Atribuição de Status Inicial | Todo pedido registrado deve entrar nativamente com o status "Pendente / Em Preparo" correspondente ao ID padrão na tabela `status_pedidos`. |
| **RF-011** | Remoção de Pedidos | O sistema deve permitir a exclusão e cancelamento de um pedido através do seu identificador único. |

### 8.2. Requisitos Não Funcionais (RNF)

Os Requisitos Não Funcionais definem os critérios de propriedade, restrições tecnológicas, segurança e usabilidade que determinam como as funcionalidades serão entregues.

| Identificador | Requisito Não Funcional | Critério de Aceitação Técnico |
| :--- | :--- | :--- |
| **RNF-001** | Persistência Relacional | O Sistema de Gerenciamento de Banco de Dados obrigatoriamente deve ser o PostgreSQL (versão 13 ou superior). |
| **RNF-002** | Abstração de Banco de Dados | A comunicação entre o backend e o SGBD deve ser realizada exclusivamente através da extensão nativa PDO (`PDO_PGSQL`). |
| **RNF-003** | Consistência Transacional | O módulo de criação de pedidos deve operar sob transações atómicas (`beginTransaction`, `commit`, `rollBack`) para evitar a gravação parcial de dados em caso de falha. |
| **RNF-004** | Segurança contra SQL Injection | Todas as consultas dinâmicas que envolvam parâmetros vindos do usuário devem usar queries parametrizadas com bind explícito (`bindParam` ou `bindValue`). |
| **RNF-005** | Padronização Visual (UI) | A interface gráfica do usuário deve ser renderizada baseando-se estritamente nas classes utilitárias do framework Tailwind CSS, utilizando paleta em tons terrosos e dourados. |
| **RNF-006** | Arquitetura de Roteamento | O arquivo raiz `index.php` deve agir como um interceptador de requisições, redirecionando usuários não autenticados imediatamente para o fluxo de login. |
| **RNF-007** | Responsividade | O painel executivo e as telas de leitura com janelas modais devem se adaptar de forma fluida a diferentes resoluções de telas, garantindo a usabilidade em tablets e monitores desktop. |

## 9. Script de Instalação do Banco de Dados (SQL)

```sql
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE clientes (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    cep VARCHAR(9) NOT NULL,
    numerocasa VARCHAR(20) NOT NULL,
    telefone VARCHAR(20) NOT NULL
);

CREATE TABLE produtos (
    id SERIAL PRIMARY KEY,
    sabor VARCHAR(100) NOT NULL,
    preco NUMERIC(10,2) NOT NULL,
    tipo BOOLEAN DEFAULT TRUE NOT NULL
);

CREATE TABLE status_pedidos (
    id SERIAL PRIMARY KEY,
    descricao VARCHAR(50) NOT NULL
);

INSERT INTO status_pedidos (id, descricao) VALUES (1, 'Pendente / Em Preparo');

CREATE TABLE pedidos (
    id SERIAL PRIMARY KEY,
    idcliente INTEGER NOT NULL,
    idusuario INTEGER NOT NULL,
    idprodutos INTEGER NOT NULL,
    quantidade INTEGER NOT NULL,
    idstatus INTEGER DEFAULT 1 NOT NULL,
    
    CONSTRAINT fk_pedidos_cliente FOREIGN KEY (idcliente) REFERENCES clientes(id) ON DELETE RESTRICT,
    CONSTRAINT fk_pedidos_usuario FOREIGN KEY (idusuario) REFERENCES usuarios(id) ON DELETE RESTRICT,
    CONSTRAINT fk_pedidos_produto FOREIGN KEY (idprodutos) REFERENCES produtos(id) ON DELETE RESTRICT,
    CONSTRAINT fk_pedidos_status FOREIGN KEY (idstatus) REFERENCES status_pedidos(id) ON DELETE RESTRICT
);
