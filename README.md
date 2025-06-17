🎯 latinad-api
📦 Requisitos
PHP 8.2+

Composer

Laravel 12

MySQL o compatible

⚙️ Instalación
📥 Clona el repositorio:
git clone git@github.com:MadBrain4/latinad-api.git
cd latinad-api

📦 Instala dependencias:
composer install

🛠️ Copia el archivo .env y configúralo:
cp .env.example .env
Ajusta las variables de entorno (base de datos, JWT, etc.)

🔑 Genera la clave de aplicación:
php artisan key:generate

🧱 Ejecuta migraciones y seeders:
php artisan migrate --seed

🔐 Genera la clave JWT:
php artisan jwt:secret

🚀 Inicia el servidor:
php artisan serve

📡 Endpoints
🔐 Autenticación
📨 POST /register
Registra un nuevo usuario.
Parámetros:

name

email

password

password_confirmation

🔐 POST /login
Autentica y devuelve un token JWT.
Parámetros:

email

password

🚪 POST /logout
Cierra la sesión (requiere token JWT).

🖥️ Displays (pantallas)
Todas las rutas requieren token JWT (Authorization: Bearer {token})

📄 GET /displays
Lista todas las pantallas.

➕ POST /displays
Crea una nueva pantalla.
Parámetros requeridos:

name

description

price_per_day

resolution_height

resolution_width

type (indoor | outdoor)

🔍 GET /displays/{id}
Muestra detalles de una pantalla específica.

✏️ PUT /displays/{id}
Actualiza una pantalla existente.
Parámetros: iguales a POST /displays

🗑️ DELETE /displays/{id}
Elimina una pantalla por ID.

🌐 Idioma del usuario
🧾 GET /user/language
Retorna el idioma actual del usuario.

📝 PUT /user/language
Actualiza el idioma del usuario.
Parámetro:

language (ej: es, en)

🛡️ Autenticación
Agrega el token JWT en el header:
Authorization: Bearer {token}