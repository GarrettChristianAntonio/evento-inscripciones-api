# Evaluación Técnica - Sistema de Inscripciones

**Desarrollador:** Christian Garrett  
**Framework:** Laravel 11  
**Base de Datos:** MySQL  
**Cache y Queues:** Redis  
**Correo:** Simulación mediante logs  
**Contenedor Redis:** Docker  

---

## 🧠 Decisiones de Arquitectura

Se optó por una **arquitectura basada en eventos (Event-Driven)**, con el objetivo de desacoplar acciones secundarias luego del registro exitoso de un participante. Esta decisión permite escalabilidad y mejor mantenimiento del código, facilitando la incorporación de nuevas funcionalidades de forma limpia.

### 🔹 Desacoplamiento de responsabilidades

Al registrar un participante, se dispara un evento `ParticipanteRegistrado`, el cual tiene dos listeners:

1. **EnviarCorreoBienvenida** – simula el envío de un correo asincrónicamente (utilizando colas).
2. **ActualizarContadorInscripciones** – actualiza un contador global en Redis de manera inmediata.

Este enfoque respeta el **principio de responsabilidad única** (SRP) y permite que las tareas se ejecuten de forma independiente y desacoplada.

---

## 🚀 Stack Técnico

| Herramienta    | Propósito                                 |
|----------------|--------------------------------------------|
| Laravel 11     | Backend y API REST                         |
| MySQL          | Base de datos principal                    |
| Redis          | Cache y driver para queues                 |
| Docker         | Contenedor Redis                           |
| Laravel Queues | Procesamiento asincrónico de eventos       |
| Log            | Simulación de envío de email               |
| Laravel Lang   | Traducciones de validaciones al español    |

---

## ⚙️ Instalación y Puesta en Marcha del Proyecto

### 1. Clonar el repositorio

```bash
git clone https://github.com/tuusuario/evento-inscripciones-api.git
cd evento-inscripciones-api
```
### 2. Configurar el archivo .env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:GENERADO_CON_ARTISAN
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inscripcionesbd
DB_USERNAME=root
DB_PASSWORD=

CACHE_STORE=redis
QUEUE_CONNECTION=redis

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379


### 3. Configurar Redis con Docker

Asegúrate de tener Docker instalado y luego ejecutá:

```bash
docker run --name redis-laravel -p 6379:6379 -d redis
```
Esto levantará un contenedor Redis local en el puerto 6379.




## 🧪 Ejecución del Proyecto


### 1. Migrar la base de datos

```bash
php artisan migrate
```

### 2. Ejecutar el servidor de desarrollo
```bash
php artisan serve
```

### 3. Ejecutar el worker de colas

Para procesar los listeners asincrónicos:

```bash
php artisan queue:work
```
