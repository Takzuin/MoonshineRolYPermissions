# MoonshineRolYPermissions
Sistema administrativo para la gestión de departamentos, empleados y proyectos desarrollado con Laravel y el panel administrativo Moonshine con Roles Y permisos.

## Descripción
Este sistema permite administrar:
- **Departamentos**: Accounting, HR, IT y Production
- **Empleados**: Asignados a un único departamento
- **Proyectos**: Con título, fecha límite y presupuesto
- **Roles** Y **Permisos**: Implementados con Spatie Laravel-permission

## Requisitos previos
- PHP 8.1 o superior
- Composer
- MySQL o PostgreSQL
- Node.js y npm (para compilar assets)
- Git

## Pasos para instalar el proyecto
Sigue estos pasos para instalar y ejecutar el proyecto en tu entorno local:

### 1. Clonar el repositorio
```bash
git clone https://github.com/tu-usuario/nombre-del-repositorio.git
cd nombre-del-repositorio
```

### 2. Instalar dependencias de PHP
```bash
composer install
```

### 3. Configurar el entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar la base de datos
Edita el archivo `.env` con tus credenciales de base de datos:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_bd
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Ejecutar migraciones
```bash
php artisan migrate
```

### 6. Crear roles y permisos iniciales
```bash
php artisan db:seed --class=RolePermissionSeeder
```
Este comando ejecutará el seeder que crea los roles y permisos básicos del sistema.

### 7. Crear usuario administrador
```bash
php artisan moonshine:user
```
Sigue las instrucciones en la terminal para crear tu usuario administrador.

### 8. Asignar rol de administrador al usuario creado
```bash
php artisan assign:admin-role
```
Este comando asigna el rol de administrador al usuario creado anteriormente. Si necesitas asignar el rol a un usuario específico, puedes usar:
```bash
php artisan assign:admin-role --email=admin@ejemplo.com
```

### 9. Compilar assets
```bash
npm install
npm run dev
```

Si encuentras un error de PowerShell relacionado con la ejecución de scripts deshabilitada cuando ejecutas `npm install`, sigue estos pasos:
1. Abre PowerShell como Administrador (clic derecho en PowerShell y selecciona "Ejecutar como administrador")
2. Ejecuta uno de estos comandos para cambiar la política de ejecución:
   ```powershell
   Set-ExecutionPolicy -Scope CurrentUser -ExecutionPolicy RemoteSigned
   ```
   O para una configuración más permisiva:
   ```powershell
   Set-ExecutionPolicy -Scope CurrentUser -ExecutionPolicy Unrestricted
   ```
3. Confirma el cambio escribiendo "Y" cuando se te solicite
4. Intenta ejecutar `npm install` nuevamente en el directorio de tu proyecto

### 10. Iniciar el servidor
```bash
php artisan serve
```

### 11. Acceder al panel de administración
Visita `http://localhost:8000/admin` en tu navegador y utiliza las credenciales que creaste en el paso 7.

## Estructura del proyecto
```
├── app
│   ├── Models
│   │   ├── Department.php
│   │   ├── Employee.php
│   │   └── Project.php
│   ├── MoonShine
│   │   ├── Resources
│   │   │   ├── DepartmentResource.php
│   │   │   ├── EmployeeResource.php
│   │   │   └── ProjectResource.php
│   │   └── ...
│   └── Console
│       └── Commands
│           └── AssignAdminRole.php
├── database
│   ├── migrations
│   │   ├── xxxx_xx_xx_create_departments_table.php
│   │   ├── xxxx_xx_xx_create_employees_table.php
│   │   └── xxxx_xx_xx_create_projects_table.php
│   └── seeders
│       └── RolePermissionSeeder.php
└── ...
```

## Gestión de roles y permisos con Spatie
Este proyecto utiliza el paquete [spatie/laravel-permission](https://github.com/spatie/laravel-permission) para la gestión de roles y permisos. Para crear roles y permisos adicionales, puedes:

1. Modificar el seeder `RolePermissionSeeder.php`
2. Crear y ejecutar nuevos seeders específicos para roles o permisos
3. Usar la API de Spatie en tu código:

```php
// Crear un rol
$role = Role::create(['name' => 'editor']);

// Crear un permiso
$permission = Permission::create(['name' => 'edit articles']);

// Asignar permiso a un rol
$role->givePermissionTo($permission);

// Asignar rol a un usuario
$user->assignRole('editor');
```

## Comandos personalizados
El proyecto incluye comandos personalizados para facilitar la gestión de usuarios y permisos:

1. **Asignar rol de administrador**:
   ```bash
   php artisan assign:admin-role --email=user@example.com
   ```

2. **Crear nuevo rol con permisos**:
   ```bash
   php artisan make:role nombre_del_rol --permissions="permiso1,permiso2"
   ```

## Recuperación de contraseña
Si pierdes la contraseña del administrador, puedes restablecerla con alguno de estos métodos:

1. **Usar el comando de Moonshine**:
   ```bash
   php artisan moonshine:user
   ```
   Especifica el correo electrónico existente y establece una nueva contraseña.

2. **Mediante Tinker**:
   ```bash
   php artisan tinker
   >>> $user = \MoonShine\Models\MoonshineUser::where('email', 'admin@ejemplo.com')->first();
   >>> $user->password = bcrypt('nueva_contraseña');
   >>> $user->save();
   ```

## Contribución
Si deseas contribuir a este proyecto, por favor:
1. Crea un fork del repositorio
2. Crea una rama para tu característica (`git checkout -b feature/nueva-caracteristica`)
3. Haz commit de tus cambios (`git commit -m 'Añadir nueva característica'`)
4. Sube la rama (`git push origin feature/nueva-caracteristica`)
5. Abre un Pull Request

## Licencia
Este proyecto está licenciado bajo [MIT License](LICENSE).
