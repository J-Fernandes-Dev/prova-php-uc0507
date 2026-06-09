# Prova Prática: Desenvolvimento Web Dinâmico (UC0507)

Este projeto foi desenvolvido como avaliação prática para o curso de Design e Construção de Websites. Consiste numa plataforma web modular com integração de Base de Dados (MySQL) e foco em segurança.

## 🚀 Funcionalidades
* **Arquitetura Dinâmica:** Páginas estruturadas de forma modular em PHP (`includes/header.php` e `includes/footer.php`).
* **Ligação à BD:** Listagem automatizada de artigos utilizando a extensão **PDO** com tratamento de exceções.
* **Segurança Ativa:** Proteção robusta contra ataques **XSS (Cross-Site Scripting)** através da higienização de dados na camada de visualização.
* **Layout Responsivo:** Interface moderna (tema escuro) construída com **CSS Grid** e formulários organizados de forma bi-coluna.

## 🛠️ Tecnologias Utilizadas
* PHP 8.x
* MySQL (PDO)
* HTML5 / CSS3 (CSS Grid & Flexbox)

## 📦 Como correr o projeto localmente
1. Clone este repositório para a pasta `htdocs` do seu servidor local (MAMP/XAMPP).
2. Importe o ficheiro SQL da base de dados (caso incluas a estrutura).
3. Configure as credenciais em `config/conexao_pdo.php`.
4. Aceda a `localhost:8888/nome-da-pasta`.