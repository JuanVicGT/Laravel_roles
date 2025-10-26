Para definir un nuevo módulo hay que tener en cuenta:

- Para indicar los permisos que va a agregar el módulo en la raiz del mismo se debe agregar un archivo .json llamado "settings.json"
- Para que el módulo agregué ventanas en el menú se debe agregar el archivo pages.json

Para poder reconocer la estructura de dichos .json se puede basar en el módulo "core" que siempre debe existir.

Además, también se debe tomar en cuenta:

- La estructura de archivos es la misma que en Laravel normal, solo que dentro de los propios módulos, si se desea agregar alguna ruta o vista, se puede hacer dentro de los módulos.
- También sedders y migraciones pueden declararse dentro de los módulos.
- Si se desea sobreescribir funciones del core o de otros módulos, se tiene que indicar la prioridad de cada módulo y con ello se aplicaran los cambios (la sobre escritura no sirve actualmente para el menú, se tendría que gestionar desde las rutas web u otros archivos)