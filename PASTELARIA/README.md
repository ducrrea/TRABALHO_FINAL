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

## 5. Script de Instalação do Banco de Dados (SQL)

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