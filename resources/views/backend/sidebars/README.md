# Descripción
En esta carpeta se encuentran todos los menús laterales de las vistas, no se tenrá un archivo por cada vista en la que se desee un menú lateral, por lo que el titulo hace referencia a la ruta del navbar en la que se encuentra la vista donde se carga el menú con un prefijo "list".

Ejemplo con la opción del navbar "User" que tiene el menú lateral para los usuarios, roles y permisos:

- list_(ruta accesible desde el navbar).blade.php
- list_admin_user.blade.php

En caso de tener un menú lateral en vistas create/edit/show que no son accesibles desde el navbar, se deberá agregar un prefijo "create/edit/show" seguido de la vista principal a los archivos, significando que es una vista que no se puede acceder directamente desde el navbar. Por lo que ya no se tendrá que agregar la ruta en la que se accede.

Ejemplo para la edición de un usuario, donde no necesitamos ver las vistas especializadas en los permisos y roles, pero si queremos manejar un menú lateral para diversificar las opciones del usuario.

- edit_(vista).blade.php
- edit_user.blade.php