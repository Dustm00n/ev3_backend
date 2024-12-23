<?php
require_once 'config/auth.php';
require_once 'basicInfo.php';
require_once 'services.php';
require_once 'about.php';
require_once 'contacto-rrss/cotactoController.php';
require_once 'quienes-somos/quienesController.php';
require_once 'estilo-visual/estilo-visual.php';
require_once 'productos-servicios/productos-servicios.php';
require_once 'informacion-basica/informacioController.php'; // Añadir esta línea

// Obtener la ruta solicitada
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);
$pathSegments = explode('/', trim($path, '/'));

// Verificar la ruta y aplicar autenticación si es necesario
if (isset($pathSegments[3])) {
    $endpoint = $pathSegments[3];
    $method = $_SERVER['REQUEST_METHOD'];

    // Verificar autenticación
    if (!isAuthenticated($endpoint)) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

    switch ($endpoint) {
        case 'contacto-rrss':
            switch ($method) {
                case 'GET':
                    $data = getContactInfo();
                    break;
                case 'POST':
                    $data = addContactInfo();
                    break;
                case 'PUT':
                    $data = updateContactInfo();
                    break;
                case 'DELETE':
                    $data = disableContactInfo();
                    break;
                case 'PATCH':
                    $data = enableContactInfo();
                    break;
                default:
                    http_response_code(405);
                    $data = ['error' => 'Method Not Allowed'];
                    break;
            }
            break;
        case 'estilo-visual':
            switch ($method) {
                case 'GET':
                    handle_estilo_visual_get();
                    break;
                case 'POST':
                    handle_estilo_visual_post();
                    break;
                case 'PUT':
                    handle_estilo_visual_put();
                    break;
                case 'DELETE':
                    handle_estilo_visual_delete();
                    break;
                case 'PATCH':
                    handle_estilo_visual_patch();
                    break;
                default:
                    http_response_code(405);
                    $data = ['error' => 'Method Not Allowed'];
                    break;
            }
            break;
        case 'productos-servicios':
            switch ($method) {
                case 'GET':
                    handle_productos_servicios_get();
                    break;
                case 'POST':
                    handle_productos_servicios_post();
                    break;
                case 'PUT':
                    handle_productos_servicios_put();
                    break;
                case 'DELETE':
                    handle_productos_servicios_delete();
                    break;
                case 'PATCH':
                    handle_productos_servicios_patch();
                    break;
                default:
                    http_response_code(405);
                    $data = ['error' => 'Method Not Allowed'];
                    break;
            }
            break;
        case 'informacion-basica': // Añadir este caso
            switch ($method) {
                case 'GET':
                    $data = getInformacionBasica();
                    break;
                case 'PUT':
                    $data = updateInformacionBasica();
                    break;
                case 'DELETE':
                    $data = disableInformacionBasica();
                    break;
                case 'PATCH':
                    $data = enableInformacionBasica();
                    break;
                default:
                    http_response_code(405);
                    $data = ['error' => 'Method Not Allowed'];
                    break;
            }
            break;
        default:
            http_response_code(404);
            $data = ['error' => 'Not Found'];
            break;
    }
} else {
    $data = [
        'basic-info' => getBasicInfo(),
        'services' => getServices(),
        'about-us' => getAboutInfo()
    ];
}

// Return del contenido
echo json_encode($data);
?>