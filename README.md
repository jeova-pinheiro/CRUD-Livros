# 📚 CRUD de Livros - Laravel API

Projeto desenvolvido para a disciplina de **Integração de Sistemas** do curso de Sistemas da Informação da Universidade Estadual do Sudoeste da Bahia (UESB).

## 📌 Descrição

Este projeto consiste na implementação de uma **API RESTful** com operações CRUD (Create, Read, Update, Delete) sobre uma entidade **Livro**, utilizando o framework **Laravel** com **MySQL** como banco de dados.

A API permite cadastrar, listar, atualizar e remover livros, bem como consultar um livro individualmente. Todas as requisições e respostas são tratadas no formato **JSON**.

## 👨‍🏫 Disciplina

**Integração de Sistemas**  
Professor: *Eudes Diônatas Silva Souza*  
Entrega: *22 de maio de 2025*

## 🧑‍💻 Equipe (Grupo JSON)

- Alisson Tito  
- Éric Meira  
- Jeová Pinheiro  
- Juan Felix  

## 🔧 Tecnologias Utilizadas

- PHP 8.x  
- Laravel 10.x  
- MySQL  
- Composer  
- Git  

## 🚀 Como Executar o Projeto

### 1. Clone o repositório

```bash
git clone https://github.com/jeova-pinheiro/CRUD-Livros-Laravel.git
cd CRUD-Livros-Laravel
```

### 2. Instale as dependências

```bash
composer install
```

### 3. Configure o `.env`

Copie o arquivo `.env.example` para `.env` e configure os dados do seu banco MySQL:

```env
DB_DATABASE=biblioteca
DB_USERNAME=root
DB_PASSWORD=suasenha
```

### 4. Gere a chave da aplicação

```bash
php artisan key:generate
```

### 5. Execute as migrations

```bash
php artisan migrate
```

### 6. Inicie o servidor

```bash
php artisan serve
```

A aplicação estará disponível em: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔁 Rotas da API

| Método  | Rota                 | Descrição                                                                 |
|---------|----------------------|---------------------------------------------------------------------------|
| GET     | `/api/livros`        | Lista todos os livros cadastrados.                                       |
| GET     | `/api/livros/{id}`   | Retorna os dados de um livro específico pelo ID.                         |
| POST    | `/api/livros`        | Cadastra um novo livro.                                                  |
| PUT     | `/api/livros/{id}`   | Atualiza os dados de um livro existente (parcial ou completo).           |
| DELETE  | `/api/livros/{id}`   | Remove um livro do banco de dados.                                       |
| GET     | `/api/ping`          | Testa a comunicação com a API (retorna status true e mensagem “Pong”).   |

---

## 📦 Parâmetros Esperados

### 📌 POST /api/livros

```json
{
  "LIV_TITULO": "Dom Casmurro",
  "LIV_AUTOR": "Machado de Assis",
  "LIV_ANO": 1899,
  "LIV_GENERO": "Romance",
  "LIV_EDITORA": "Editora Brasileira"
}
```

### ✏️ PUT /api/livros/{id}

```json
{
  "LIV_TITULO": "Memórias Póstumas de Brás Cubas",
  "LIV_ANO": 1881
}
```

---

## ✅ Validações

- `LIV_TITULO`, `LIV_AUTOR`, `LIV_GENERO`, `LIV_EDITORA`: Strings com até 255 caracteres.
- `LIV_ANO`: Número inteiro de 4 dígitos entre 1000 e o ano atual.

