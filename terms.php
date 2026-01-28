<?php
// terms.php
$headerDepth = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones de Uso | Candelaria 2026</title>
    <meta name="view-transition" content="same-origin">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Open Sans', sans-serif; background-color: #f8fafc; color: #334155; }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; color: #1e293b; }
        .legal-text p { margin-bottom: 1.25rem; line-height: 1.8; text-align: justify; }
        .legal-text ul { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.25rem; }
        .legal-text li { margin-bottom: 0.75rem; padding-left: 0.5rem; }
        .clause-title { color: #0f172a; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem; font-size: 1.25rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5rem; }
    </style>
</head>
<body class="bg-slate-50">
    <?php
    $activePage = '';
    if (file_exists('includes/standard-header.php')) {
        require_once 'includes/standard-header.php';
    }
    ?>

    <main class="max-w-5xl mx-auto px-6 py-16">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
            <!-- Header Banner -->
            <div class="bg-gradient-to-r from-purple-900 to-indigo-900 p-12 text-white text-center relative">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4 relative z-10 tracking-tight">Términos y Condiciones</h1>
                <p class="text-purple-200 text-lg relative z-10 font-medium">Acuerdo Legal de Servicio</p>
                <div class="mt-6 flex justify-center gap-4 text-xs font-mono uppercase tracking-widest text-purple-300 opacity-80">
                    <span>Ref: TOS-2026-V3</span>
                    <span>•</span>
                    <span>Vigencia: Inmediata</span>
                </div>
            </div>

            <div class="p-8 md:p-16 legal-text text-slate-600 text-sm md:text-base">
                <div class="bg-amber-50 p-6 rounded-lg border border-amber-200 text-amber-900 mb-10 text-sm">
                    <strong>AVISO IMPORTANTE:</strong> ESTOS TÉRMINOS CONTIENEN DISPOSICIONES DE ARBITRAJE OBLIGATORIO Y RENUNCIA A DEMANDAS COLECTIVAS QUE AFECTAN SUS DERECHOS LEGALES. POR FAVOR, LÉALOS DETENIDAMENTE.
                </div>

                <h3 class="clause-title">1. ACEPTACIÓN DE LOS TÉRMINOS</h3>
                <p>Bienvenido a mipuno.pe (en adelante, la "Plataforma"). Estos Términos y Condiciones de Uso ("Términos") constituyen un contrato legalmente vinculante entre usted (el "Usuario", "Usted") y Candelaria Digital S.A.C. ("Nosotros", "La Empresa", "La Plataforma").</p>
                <p>AL ACCEDER, NAVEGAR, REGISTRARSE O UTILIZAR CUALQUIER PARTE DE NUESTROS SERVICIOS, USTED RECONOCE QUE HA LEÍDO, COMPRENDIDO Y ACEPTADO ESTAR SUJETO A ESTOS TÉRMINOS SIN RESERVAS NI LIMITACIONES. SI NO ESTÁ DE ACUERDO CON ESTOS TÉRMINOS, NO DEBE UTILIZAR NUESTROS SERVICIOS.</p>

                <h3 class="clause-title">2. ELEGIBILIDAD Y CUENTA DE USUARIO</h3>
                <ul>
                    <li><strong>Edad Mínima:</strong> Debe tener al menos 18 años de edad (o la mayoría de edad en su jurisdicción) para formalizar un contrato vinculante. Si es menor de 18 pero mayor de 13, solo puede usar los Servicios bajo la supervisión de un padre o tutor que acepte estos Términos.</li>
                    <li><strong>Registro:</strong> Para acceder a ciertas funcionalidades, debe crear una cuenta proporcionando información veraz, exacta, actual y completa. El uso de alias ofensivos o impersonación está estrictamente prohibido.</li>
                    <li><strong>Seguridad de la Cuenta:</strong> Usted es el único responsable de mantener la confidencialidad de sus credenciales de acceso. Cualquier actividad realizada desde su cuenta se presumirá realizada por usted. Debe notificarnos inmediatamente sobre cualquier brecha de seguridad.</li>
                    <li><strong>Terminación:</strong> Nos reservamos el derecho de suspender o eliminar su cuenta unilateralmente si detectamos violaciones a estos términos, actividad fraudulenta o inactividad prolongada, sin derecho a compensación alguna.</li>
                </ul>

                <h3 class="clause-title">3. USO PERMITIDO Y RESTRICCIONES</h3>
                <p>Se le otorga una licencia limitada, no exclusiva, intransferible y revocable para acceder y utilizar la Plataforma estrictamente de acuerdo con estos Términos. Queda expresamente prohibido:</p>
                <ul>
                    <li>Utilizar los Servicios para fines ilícitos, fraudulentos o no autorizados.</li>
                    <li>Intentar acceder, manipular o utilizar áreas no públicas de la Plataforma, nuestros sistemas informáticos o los sistemas de entrega técnica de nuestros proveedores.</li>
                    <li>Introducir virus, troyanos, gusanos, bombas lógicas u otro material malicioso o tecnológicamente dañino.</li>
                    <li>Realizar ingeniería inversa, descompilar o desensamblar cualquier software utilizado para proporcionar los Servicios.</li>
                    <li>Utilizar bots, scrapers o herramientas automatizadas para recopilar datos sin nuestro consentimiento expreso por escrito.</li>
                    <li>Acosar, amenazar o intimidar a otros usuarios o al personal de la Empresa.</li>
                </ul>

                <h3 class="clause-title">4. PROPIEDAD INTELECTUAL</h3>
                <p>Todos los derechos, títulos e intereses sobre la Plataforma y su contenido (incluyendo pero no limitado a software, texto, gráficos, logotipos, iconos, imágenes, clips de audio, descargas digitales y compilaciones de datos) son propiedad exclusiva de Candelaria Digital o sus licenciantes y están protegidos por las leyes de derechos de autor, marcas comerciales y otras leyes de propiedad intelectual del Perú y tratados internacionales.</p>
                <p>Las marcas "Candelaria 2026", "mipuno.pe" y los logotipos asociados son marcas registradas. No se le otorga ningún derecho o licencia sobre dichas marcas.</p>

                <h3 class="clause-title">5. CONTENIDO GENERADO POR EL USUARIO</h3>
                <p>Si usted publica comentarios, fotos, reseñas u otro contenido ("Contenido del Usuario"):</p>
                <ul>
                    <li>Usted conserva sus derechos de autor sobre su contenido.</li>
                    <li>Usted nos otorga una licencia mundial, perpetua, irrevocable, libre de regalías, sublicenciable y transferible para usar, reproducir, modificar, adaptar, publicar, traducir y distribuir dicho contenido en cualquier medio.</li>
                    <li>Usted garantiza que posee todos los derechos necesarios sobre dicho contenido y que su publicación no viola derechos de terceros.</li>
                    <li>Usted acepta que no publicará contenido difamatorio, obsceno, pornográfico, ofensivo, violento o que incite al odio.</li>
                </ul>

                <h3 class="clause-title">6. ENLACES A TERCEROS Y SERVICIOS EXTERNOS</h3>
                <p>La Plataforma puede contener enlaces a sitios web, servicios o recursos de terceros que no son propiedad ni están controlados por nosotros. No respaldamos ni asumimos responsabilidad alguna por el contenido, políticas de privacidad o prácticas de sitios web de terceros. Usted reconoce y acepta que Candelaria Digital no será responsable, directa o indirectamente, por cualquier daño o pérdida causada por el uso de dichos servicios externos.</p>

                <h3 class="clause-title">7. EXENCIÓN DE GARANTÍAS</h3>
                <p>LOS SERVICIOS SE PROPORCIONAN "TAL CUAL" Y "SEGÚN DISPONIBILIDAD", SIN GARANTÍAS DE NINGÚN TIPO, YA SEAN EXPRESAS O IMPLÍCITAS. EN LA MEDIDA MÁXIMA PERMITIDA POR LA LEY, RENUNCIAMOS A TODAS LAS GARANTÍAS, INCLUYENDO, ENTRE OTRAS, LAS GARANTÍAS IMPLÍCITAS DE COMERCIABILIDAD, IDONEIDAD PARA UN PROPÓSITO PARTICULAR Y NO INFRACCIÓN. NO GARANTIZAMOS QUE LOS SERVICIOS SERÁN ININTERRUMPIDOS, SEGUROS O LIBRES DE ERRORES.</p>

                <h3 class="clause-title">8. LIMITACIÓN DE RESPONSABILIDAD</h3>
                <p>EN NINGÚN CASO CANDELARIA DIGITAL, SUS DIRECTORES, EMPLEADOS O AGENTES SERÁN RESPONSABLES POR DAÑOS INDIRECTOS, INCIDENTALES, ESPECIALES, CONSECUENTES O PUNITIVOS, INCLUYENDO PÉRDIDA DE BENEFICIOS, DATOS O FONDO DE COMERCIO, RESULTANTES DE (I) SU ACCESO O USO DE LOS SERVICIOS; (II) CUALQUIER CONDUCTA DE TERCEROS EN LOS SERVICIOS; O (III) ACCESO, USO O ALTERACIÓN NO AUTORIZADA DE SUS TRANSMISIONES O CONTENIDO.</p>

                <h3 class="clause-title">9. INDEMNIZACIÓN</h3>
                <p>Usted acepta defender, indemnizar y eximir de responsabilidad a Candelaria Digital y sus afiliados contra cualquier reclamo, daño, obligación, pérdida, responsabilidad, costo o deuda y gasto (incluyendo honorarios de abogados) que surjan de: (i) su uso y acceso a los Servicios; (ii) su violación de cualquier término de estos Términos; o (iii) su violación de cualquier derecho de terceros.</p>

                <h3 class="clause-title">10. LEY APLICABLE Y JURISDICCIÓN</h3>
                <p>Estos Términos se regirán e interpretarán de acuerdo con las leyes de la República del Perú. Cualquier disputa que surja en relación con estos Términos se someterá a la jurisdicción exclusiva de los tribunales competentes de la ciudad de Puno, Perú, renunciando las partes a cualquier otro fuero que pudiera corresponderles.</p>

                <h3 class="clause-title">11. DISPOSICIONES GENERALES</h3>
                <p>Si alguna disposición de estos Términos se considera inválida o inaplicable, dicha disposición se limitará o eliminará en la medida mínima necesaria, y las disposiciones restantes permanecerán en pleno vigor y efecto. Nuestra falta de ejercicio de cualquier derecho o disposición no constituirá una renuncia a tal derecho.</p>

                <div class="mt-12 p-8 bg-slate-100 rounded-xl text-center">
                    <p class="font-bold text-slate-800 mb-2">Contacto Legal</p>
                    <p class="text-sm">Para notificaciones legales o preguntas sobre estos términos:</p>
                    <a href="mailto:legal@mipuno.pe" class="text-indigo-600 font-bold hover:underline">legal@mipuno.pe</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Global Footer Include (Standard) -->
    <?php 
    $footerDepth = 0;
    require_once 'includes/standard-footer.php'; 
    ?>

    <script>lucide.createIcons();</script>
</body>
</html>
