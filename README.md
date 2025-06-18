🎯 latinad-api
    API REST para gestión de pantallas publicitarias — Desafío Técnico LatinAd

📦 Requisitos
    - PHP 8.2+

    - Composer

    - Laravel 12

    - MySQL o compatible

⚙️ Instalación
    1. 📥 Clona el repositorio:
        git clone git@github.com:MadBrain4/latinad-api.git
        cd latinad-api

    2. 📦 Instala dependencias:
        composer install

    3. 🛠️ Copia el archivo .env y configúralo:
        cp .env.example .env
        Ajusta las variables de entorno (base de datos, JWT, etc.)

    4. 🔑 Genera la clave de aplicación:
        php artisan key:generate

    5. 🧱 Ejecuta migraciones y seeders:
        php artisan migrate --seed

    6. 🔐 Genera la clave JWT:
        php artisan jwt:secret

    7. 🚀 Inicia el servidor:
        php artisan serve

📡 Endpoints

    🔐 Autenticación

        📨 POST /api/register: Registrar un nuevo usuario

        Body (JSON)
        - name: string
        - email: string
        - password: string
        - password_confirmation: string

        🔓 No requiere autenticación.


        🔐 POST /login: Iniciar sesión y retornar un token JWT
        Body (JSON)
        - email: string
        - password: string

        🔓 No requiere autenticación.


        🚪 POST /logout: Cierra la sesión.

        🔓 Requiere autenticación.

    🖥️ Displays (pantallas)

        Todas las rutas requieren token JWT (Authorization: Bearer {token})

        📄 GET /displays: Lista todas las pantallas.

        ➕ POST /displays: Crea una nueva pantalla.
        Body (JSON)
        - name: string
        - description: string
        - price_per_day: float
        - resolution_height: int
        - resolution_width: int
        - type: indoor | outdoor

        🔍 GET /displays/{id}: Muestra detalles de una pantalla específica.

        ✏️ PUT /displays/{id}: Actualiza una pantalla existente.
        Body (JSON)
        - name: string
        - description: string
        - price_per_day: float
        - resolution_height: int
        - resolution_width: int
        - type: indoor | outdoor

        🗑️ DELETE /displays/{id}: Elimina una pantalla por ID.

    🌐 Idioma del usuario

        🧾 GET /user/language: Retorna el idioma actual del usuario.

        📝 PUT /user/language: Actualiza el idioma del usuario.
        Body (JSON)
        - language: string (por ejemplo, es o en)

    🛡️ Autenticación
    Agrega el token JWT en el header:
    Authorization: Bearer {token}