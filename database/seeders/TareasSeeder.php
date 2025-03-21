<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tarea;
use Faker\Factory as Faker;

class TareasSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$faker = Faker::create();

		$tareas = [
				['titulo' => 'Diseñar la estructura del sitio web', 'detalles' => 'Planificar y definir la estructura del sitio web, incluyendo las páginas principales, su jerarquía y la navegación entre ellas. Esto asegurará una experiencia de usuario intuitiva y organizada.', 'estado' => 'pendiente', 'prioridad' => 'alta'],
				['titulo' => 'Configurar el entorno de desarrollo', 'detalles' => 'Instalar y configurar XAMPP, junto con otras herramientas necesarias como editores de código, control de versiones y dependencias, para garantizar un entorno de desarrollo funcional y eficiente.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Crear la base de datos', 'detalles' => 'Diseñar y construir la base de datos, definiendo las tablas, campos y relaciones necesarias para almacenar y gestionar los datos del sitio de manera eficiente.', 'estado' => 'en_progreso', 'prioridad' => 'alta'],
				['titulo' => 'Diseñar el logo del sitio', 'detalles' => 'Crear un logo profesional y atractivo que represente la identidad visual del sitio web, utilizando herramientas de diseño gráfico y considerando la marca.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Implementar la página de inicio', 'detalles' => 'Diseñar y desarrollar la página principal del sitio, asegurando que sea visualmente atractiva, funcional y que comunique claramente el propósito del sitio.', 'estado' => 'pendiente', 'prioridad' => 'alta'],
				['titulo' => 'Crear el sistema de autenticación', 'detalles' => 'Desarrollar un sistema que permita a los usuarios registrarse, iniciar sesión y recuperar contraseñas de manera segura, utilizando buenas prácticas de seguridad.', 'estado' => 'en_progreso', 'prioridad' => 'alta'],
				['titulo' => 'Diseñar la página de contacto', 'detalles' => 'Crear un formulario de contacto funcional que permita a los usuarios enviar consultas o mensajes directamente desde el sitio web.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Optimizar el rendimiento del sitio', 'detalles' => 'Analizar y mejorar el rendimiento del sitio web, reduciendo tiempos de carga, optimizando imágenes y minimizando el uso de recursos.', 'estado' => 'pendiente', 'prioridad' => 'alta'],
				['titulo' => 'Implementar la funcionalidad de búsqueda', 'detalles' => 'Desarrollar un buscador eficiente que permita a los usuarios encontrar contenido específico dentro del sitio de manera rápida y precisa.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Crear la página de términos y condiciones', 'detalles' => 'Redactar y diseñar una página que detalle los términos y condiciones del sitio, asegurando claridad y cumplimiento legal.', 'estado' => 'pendiente', 'prioridad' => 'baja'],
				['titulo' => 'Configurar el servidor de producción', 'detalles' => 'Preparar el servidor para el despliegue del sitio, configurando el entorno, asegurando la seguridad y optimizando el rendimiento.', 'estado' => 'pendiente', 'prioridad' => 'alta'],
				['titulo' => 'Realizar pruebas de usabilidad', 'detalles' => 'Llevar a cabo pruebas con usuarios reales para identificar problemas de usabilidad y mejorar la experiencia general del sitio.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Implementar la página de servicios', 'detalles' => 'Diseñar y desarrollar una página que muestre los servicios ofrecidos, destacando sus características y beneficios.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Crear la página de preguntas frecuentes', 'detalles' => 'Diseñar una sección que responda a las preguntas más comunes de los usuarios, mejorando la accesibilidad a la información.', 'estado' => 'pendiente', 'prioridad' => 'baja'],
				['titulo' => 'Configurar el sistema de correos', 'detalles' => 'Habilitar el envío de correos electrónicos desde el sitio, asegurando la funcionalidad para notificaciones y comunicación con los usuarios.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Diseñar la página de blog', 'detalles' => 'Crear una sección para publicar artículos, con un diseño atractivo y funcional que fomente la lectura y el engagement.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Implementar el sistema de comentarios', 'detalles' => 'Desarrollar una funcionalidad que permita a los usuarios dejar comentarios en los artículos, fomentando la interacción.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Crear la página de perfil de usuario', 'detalles' => 'Diseñar y desarrollar una página personalizada donde los usuarios puedan gestionar su información y preferencias.', 'estado' => 'pendiente', 'prioridad' => 'alta'],
				['titulo' => 'Agregar soporte para múltiples idiomas', 'detalles' => 'Implementar una funcionalidad que permita a los usuarios cambiar el idioma del sitio, haciéndolo accesible a una audiencia global.', 'estado' => 'pendiente', 'prioridad' => 'alta'],
				['titulo' => 'Implementar la funcionalidad de carrito de compras', 'detalles' => 'Desarrollar un carrito de compras que permita a los usuarios agregar, eliminar y gestionar productos antes de realizar una compra.', 'estado' => 'pendiente', 'prioridad' => 'alta'],
				['titulo' => 'Diseñar la página de productos', 'detalles' => 'Crear una página que muestre los productos disponibles, con detalles claros y un diseño atractivo.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Configurar el sistema de pagos', 'detalles' => 'Habilitar pagos en línea de manera segura, integrando pasarelas de pago confiables y cumpliendo con estándares de seguridad.', 'estado' => 'pendiente', 'prioridad' => 'alta'],
				['titulo' => 'Crear la página de testimonios', 'detalles' => 'Diseñar una sección donde los clientes puedan compartir sus opiniones y experiencias, generando confianza en nuevos usuarios.', 'estado' => 'pendiente', 'prioridad' => 'baja'],
				['titulo' => 'Implementar notificaciones en tiempo real', 'detalles' => 'Agregar una funcionalidad que permita enviar notificaciones instantáneas a los usuarios sobre eventos importantes o actualizaciones.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Diseñar la página de galería', 'detalles' => 'Crear una sección visualmente atractiva para mostrar imágenes relacionadas con el sitio o sus servicios.', 'estado' => 'pendiente', 'prioridad' => 'baja'],
				['titulo' => 'Optimizar el sitio para SEO', 'detalles' => 'Implementar estrategias y técnicas para mejorar el posicionamiento del sitio en los motores de búsqueda, aumentando su visibilidad.', 'estado' => 'pendiente', 'prioridad' => 'alta'],
				['titulo' => 'Implementar la funcionalidad de favoritos', 'detalles' => 'Permitir a los usuarios guardar contenido como favorito para acceder a él fácilmente en el futuro.', 'estado' => 'pendiente', 'prioridad' => 'media'],
				['titulo' => 'Crear la página de estadísticas', 'detalles' => 'Diseñar una página que muestre estadísticas relevantes del sitio, como visitas, interacciones y otros datos importantes.', 'estado' => 'pendiente', 'prioridad' => 'baja'],
				['titulo' => 'Realizar pruebas de seguridad', 'detalles' => 'Evaluar y reforzar la seguridad del sitio para protegerlo contra posibles vulnerabilidades y ataques.', 'estado' => 'pendiente', 'prioridad' => 'alta'],
				['titulo' => 'Desplegar el sitio en producción', 'detalles' => 'Publicar el sitio en un entorno de producción, asegurando que esté completamente funcional y accesible para los usuarios.', 'estado' => 'pendiente', 'prioridad' => 'alta'],
		];

		foreach ($tareas as $tarea) {
				Tarea::create($tarea);
		}
	}
}
