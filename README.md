# 🚀 Laravel 12 API – To-Do List

API RESTful desenvolvida com Laravel 12 para gerenciamento de tarefas (To-Do List). Essa API fornece autenticação via Sanctum, criação de usuários, criação e gerenciamento de tarefas com controle de acesso.

---

## 📦 Requisitos

Antes de começar, verifique se você tem os seguintes softwares instalados:

- PHP 8.2+
- Composer
- MySQL 8+
- Node.js (opcional, para compilar assets)
- Git

---

## 📥 Como instalar o projeto

Siga os passos abaixo para clonar e rodar a API localmente:

### 1. Clone o repositório

```bash
git clone git@github.com:willianKsouza/pet-task-manager.git
cd laravel-todo-api


composer install

cp .env.example .env

php artisan key:generate


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo
DB_USERNAME=root
DB_PASSWORD=sua_senha


php artisan migrate --seed


🔐 Autenticação
A API utiliza Laravel Sanctum para autenticação.

use o login:'admin@gmail.com' senha:'password'
