## Menú de navegación
La carpeta "dropdowns" están hechos para los menús de los distintos módulos que tenga el sistema, dejando así en el archivo navlinks únicamente las llamadas (para no sobre cargar de opciones el menú de navegación).

Se tienen dos archivos, siendo uno la vista móvil y el otro la versión para pantallas más grandes.

- responsive_navlinks = Versión para móviles
- navlinks = Pantallas más grandes

### Menús con dropdown
Los archivos anteriores están pensados para enlaces directos, si se deseará realizar un menú que posea varias opciones, se recomienda solo ingresar el include y el grupo de elementos ingresarlos en un nuevo archivo dentro de las carpetas correspondientes.

- menu = Hace referencia a las opciones del navbar en dispositivos no móviles
- responsive_menu = Hace referencia a las opciones del navbar para dispositivos móviles

### Submenús con dropdown
En ocasiones se requiere que una de las opciones de un menú posea también varias opciones, por lo que se recomienda hacer la referencia en la carpeta de "menú" y las opciones dentro de un archivo en la carpeta "submenu"

- Nota: Para las secciones en móviles no aplican los submenús.