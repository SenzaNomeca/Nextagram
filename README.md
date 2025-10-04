<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Nextagram

Un proyecto de demostración que replica las funcionalidades clave de una plataforma de red social centrada en publicaciones e interacciones, inspirado en Instagram para probar mis conocimientos en Laravel, logica de PHP y manejo de bases de datos.

---

## 💡 Sobre el Proyecto

**Nextagram** es una aplicación desarrollada para simular las interacciones esenciales de una red social. El objetivo principal es demostrar la capacidad de construir una aplicación web transaccional completa, con gestión de contenido de usuario y dinámica social.

### Características Implementadas

* **Gestión de Publicaciones:** Creación, visualización y eliminación de publicaciones por parte del usuario.
* **Sistema de "Me Gusta" (Likes):** Los usuarios autenticados pueden interactuar con las publicaciones.
* **Comentarios:** Funcionalidad para dejar y visualizar comentarios en cada post.
* **Autenticación de Usuarios:** Registro e inicio de sesión seguro.

---

## 🛠️ Stack Tecnológico

Este proyecto fue construido utilizando el ecosistema de Laravel, demostrando un sólido conocimiento en desarrollo backend y prácticas MVC.

* **Backend Framework:** **Laravel** (PHP)
* **Lenguajes:** PHP, JavaScript
* **Bases de Datos:** SQL (a través de Eloquent ORM)
* **Vistas:** Blade
* **Estilos:** SCSS

---

## ⚙️ Configuración e Instalación

Sigue estos pasos para levantar el proyecto en tu entorno local. Se requiere tener **PHP** y **Composer** instalados.

1.  **Clonar el Repositorio:**
    ```bash
    git clone [https://github.com/SenzaNomeca/Nextagram.git](https://github.com/SenzaNomeca/Nextagram.git)
    cd Nextagram
    ```

2.  **Instalar Dependencias de PHP:**
    ```bash
    composer install
    ```

3.  **Configurar el Entorno:**
    Copia el archivo de ejemplo y genera una clave de aplicación.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Asegúrate de configurar tu conexión a la base de datos en el archivo `.env`.*

4.  **Ejecutar Migraciones:**
    Crea las tablas de la base de datos y, opcionalmente, ejecuta los seeders si existen.
    ```bash
    php artisan migrate
    # php artisan db:seed # Si hay datos de prueba
    ```

5.  **Compilar Assets (Frontend):**
    Se usa Vite, instala las dependencias de Node e inicia la compilación.
    ```bash
    npm install
    npm run dev  # o npm run build
    ```

6.  **Iniciar el Servidor de Desarrollo de Laravel:**
    ```bash
    php artisan serve
    ```
    Normalmente la aplicación estará disponible en `http://127.0.0.1:8000` (o similar).
