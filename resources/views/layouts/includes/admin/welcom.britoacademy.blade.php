<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brito Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Brito Academy</h1>
            <nav class="space-x-4">
                <a href="#" class="hover:text-gray-200">Inicio</a>
                <a href="#" class="hover:text-gray-200">Sobre Nosotros</a>
                <a href="#" class="hover:text-gray-200">Curso</a>
                <a href="#" class="hover:text-gray-200">Calendario</a>
                <a href="#" class="hover:text-gray-200">Blog</a>
                <a href="#" class="hover:text-gray-200">Contacto</a>
            </nav>
            <div class="space-x-4">
                <a href="#" class="bg-white text-blue-600 px-4 py-2 rounded-md hover:bg-gray-200">Iniciar Sesión</a>
                <a href="#" class="bg-yellow-400 text-blue-800 px-4 py-2 rounded-md hover:bg-yellow-300">Regístrate</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-cover bg-center py-20" style="background-image: url('https://source.unsplash.com/random/1600x900');">
        <div class="container mx-auto text-center text-white">
            <h2 class="text-4xl font-bold mb-4">Impulsa tu Carrera en Programación con Brito Academy</h2>
            <p class="text-lg mb-8">Clases en vivo, apoyo constante y un plan de estudios estructurado para que aprendas paso a paso.</p>
            <a href="#" class="bg-yellow-400 text-blue-800 px-6 py-3 text-lg font-semibold rounded-md hover:bg-yellow-300">Inscríbete Hoy</a>
        </div>
    </section>

    <!-- Course Details Section -->
    <section class="py-16">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold mb-6">Detalles del Curso</h3>
            <p class="text-lg mb-4">Nuestro curso cubre temas como Laravel, migraciones, rutas, CIRA, WebSocket, despliegue y mucho más.</p>
            <p class="text-lg mb-6">Estructurado en módulos desbloqueables, con evaluaciones teóricas y prácticas.</p>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h4 class="text-xl font-semibold mb-2">Clases en Vivo</h4>
                    <p>Acceso a clases en vivo para interacción directa con el instructor.</p>
                </div>
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h4 class="text-xl font-semibold mb-2">Interacción Constante</h4>
                    <p>Soporte y asesoría en grupo de WhatsApp y chat dentro de la plataforma.</p>
                </div>
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h4 class="text-xl font-semibold mb-2">Evaluaciones y Certificado</h4>
                    <p>Evaluaciones constantes para avanzar en módulos y obtener certificación.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-gray-200 py-16">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold mb-6">Testimonios de Estudiantes</h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <p class="text-gray-700">"Gracias a Brito Academy logré avanzar en mi carrera en tecnología."</p>
                    <p class="font-semibold mt-4">- Juan Pérez</p>
                </div>
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <p class="text-gray-700">"Clases en vivo y un apoyo constante, ¡inmejorable experiencia!"</p>
                    <p class="font-semibold mt-4">- María Gómez</p>
                </div>
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <p class="text-gray-700">"Recomiendo 100% Brito Academy para cualquier desarrollador."</p>
                    <p class="font-semibold mt-4">- Carlos Ramírez</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscription Section -->
    <section class="py-16">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold mb-6">Suscripción</h3>
            <p class="text-lg mb-4">Acceso al curso completo por tan solo $70 al mes. ¡Inicia tu camino en la programación con Brito Academy!</p>
            <a href="#" class="bg-yellow-400 text-blue-800 px-6 py-3 text-lg font-semibold rounded-md hover:bg-yellow-300">Suscríbete Ahora</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Brito Academy. Todos los derechos reservados.</p>
            <div class="space-x-4 mt-4">
                <a href="#" class="hover:text-gray-200">Política de Privacidad</a>
                <a href="#" class="hover:text-gray-200">Términos de Servicio</a>
                <a href="#" class="hover:text-gray-200">Ayuda</a>
            </div>
            <div class="flex justify-center space-x-4 mt-6">
                <a href="#" class="hover:text-gray-200">Facebook</a>
                <a href="#" class="hover:text-gray-200">Twitter</a>
                <a href="#" class="hover:text-gray-200">Instagram</a>
            </div>
        </div>
    </footer>

</body>
</html>
