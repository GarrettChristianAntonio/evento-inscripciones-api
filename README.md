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

### 🔁 Sistema de Colas

Para las acciones secundarias asincrónicas (como enviar un correo de bienvenida o actualizar un contador), se utilizó **Redis** como backend de colas, aprovechando su velocidad y bajo consumo de recursos. Laravel se configuró para usar colas con:
Esto permite que las tareas se procesen en segundo plano sin bloquear la respuesta de la API, mejorando la experiencia general del sistema.

#### 💡 Alternativa: Colas con base de datos

También es posible utilizar `database` como driver de colas, lo que permite persistencia de los jobs en disco. Esta opción tiene la ventaja de no perder los trabajos en caso de reinicio o caída del worker, a costa de menor rendimiento.
Pasos para implementarla:

```bash
php artisan queue:table
php artisan migrate
```
Aunque no fue utilizada en este proyecto, se entiende cómo aplicarla en contextos donde la persistencia de jobs sea prioritaria.

### ⚠️ Manejo de Fallos

No se implementó el sistema de fallos (failed_jobs), pero se puede activar fácilmente para registrar errores en los jobs asincrónicos:

```bash
php artisan queue:failed-table
php artisan migrate
```

Y configurar en .env:

QUEUE_FAILED_DRIVER=database

### 🧱 Sobre el uso de Resources

En este proyecto no fue necesario utilizarlos

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
<pre> ```
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

 ``` </pre>
### 3. Configurar Redis con Docker

Asegúrate de tener Docker instalado y luego ejecutá:

```bash
docker run --name redis-laravel -p 6379:6379 -d redis
```
Esto levantará un contenedor Redis local en el puerto 6379.

## 🧪 Ejecución del Proyecto

Pasos para el correcto funcionamiento.

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
