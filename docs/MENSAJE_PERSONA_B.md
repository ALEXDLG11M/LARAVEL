# Instrucciones para Persona B

Ya quedó lista la parte de Persona A (Backend):

- Auth (Breeze) instalado y funcionando
- Modelo Question + migración
- FormRequests de validación
- Policy (update/delete) registrada
- Controlador con middleware de clase (Laravel 12) + AuthorizesRequests
- Rutas store/show/edit/update/destroy
- Factory + seeds (2 usuarios demo + preguntas)
- Tests Feature en verde (guest/create, user/create, only author/update)
- README con pasos para correr el proyecto

## Tareas para Persona B
- Crear vistas Blade (show, edit, create)
- Navegación, mensajes flash, header con usuario autenticado
- Listado de preguntas en home
- Despliegue gratuito y PDF con capturas + link público
