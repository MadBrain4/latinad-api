<?php

namespace App\Http\Controllers\Display;

use App\Http\Controllers\Controller;
use App\Http\Requests\Display\StoreDisplayRequest;
use App\Http\Requests\Display\UpdateDisplayRequest;
use App\Models\Display;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class DisplayController extends Controller
{
    use AuthorizesRequests;

    /**
     * Listar Displays
     *
     * Retorna una lista paginada de displays del usuario autenticado.
     *
     * @group Displays
     * @authenticated
     * @header Authorization Bearer {token}
     *
     * @queryParam page int Página de resultados. Example: 1
     * @queryParam perPage int Resultados por página. Example: 10
     * @queryParam type string Filtrar por tipo de display (indoor/outdoor). Example: indoor
     * @queryParam name string Filtrar por nombre (búsqueda parcial). Example: Pantalla
     * @queryParam sort string Ordenamiento: name, name_desc. Default: created_at desc. Example: name
     *
     * @response 200 {
     *   "current_page": 1,
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Pantalla Latin Ad",
     *       "description": "Pantalla para eventos indoor",
     *       "price_per_day": 1500.00,
     *       "resolution_height": 1080,
     *       "resolution_width": 1920,
     *       "type": "indoor",
     *       "user_id": 2,
     *       "created_at": "2025-06-15T14:35:20Z",
     *       "updated_at": "2025-06-15T14:35:20Z"
     *     }
     *   ],
     *   "total": 1
     * }
    */
    public function index(Request $request)
    {
        $query = Display::where('user_id', auth('api')->id());

        if ($name = $request->get('name')) {
            $query->where('name', 'like', "%$name%");
        }

        if ($type = $request->get('type')) {
            $query->where('type', $type);
        }

        // Ordenamiento
        $sort = $request->get('sort');
        switch ($sort) {
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Paginación
        $perPage = $request->get('perPage', 10);

        return response()->json($query->paginate($perPage));
    }


        /**
     * Crear un Display
     *
     * Crea un nuevo display asociado al usuario autenticado.
     *
     * @group Displays
     * @authenticated
     * @header Authorization Bearer {token}
     *
     * @bodyParam name string required Nombre del display. Example: Pantalla Latin Ad
     * @bodyParam description string required Descripción del display. Example: Pantalla Latin 1
     * @bodyParam price_per_day float required Precio por día. Example: 1500.00
     * @bodyParam resolution_height int required Resolución vertical. Example: 1080
     * @bodyParam resolution_width int required Resolución horizontal. Example: 1920
     * @bodyParam type string required Tipo de display (indoor u outdoor). Example: outdoor
     *
     * @response 201 {
     *   "id": 7,
     *   "name": "Pantalla Latin Ad",
     *   "description": "Pantalla Latin 1",
     *   "price_per_day": 1500.00,
     *   "resolution_height": 1080,
     *   "resolution_width": 1920,
     *   "type": "outdoor",
     *   "user_id": 2,
     *   "created_at": "2025-06-17T10:00:00Z",
     *   "updated_at": "2025-06-17T10:00:00Z"
     * }
     */
    public function store(StoreDisplayRequest $request)
    {
        $display = auth('api')->user()->displays()->create($request->validated());

        return response()->json($display, 201);
    }

    /**
     * Ver un Display
     *
     * Muestra los detalles de un display específico.
     *
     * @group Displays
     * @authenticated
     * @header Authorization Bearer {token}
     *
     * @urlParam id integer required ID del display. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "name": "Pantalla LED",
     *   "type": "led",
     *   "user_id": 2,
     *   "created_at": "2024-06-01T12:34:56Z",
     *   "updated_at": "2024-06-01T12:34:56Z"
     * }
     *
     * @response 403 {
     *   "message": "Esta acción no está autorizada."
     * }
     *
     * @response 404 {
     *   "message": "Display no encontrado."
     * }
    */
    public function show($id)
    {
        $display = Display::findOrFail($id);

        $this->authorize('view', $display);

        return response()->json($display);
    }


        /**
     * Actualizar un Display
     *
     * Modifica un display existente.
     *
     * @group Displays
     * @authenticated
     * @header Authorization Bearer {token}
     *
     * @urlParam id integer required ID del display a actualizar. Example: 1
     *
     * @bodyParam name string required Nuevo nombre. Example: Pantalla Actualizada
     * @bodyParam description string required Nueva descripción. Example: Descripción actualizada de la pantalla
     * @bodyParam price_per_day float required Nuevo precio por día. Example: 150.75
     * @bodyParam resolution_height int required Nueva resolución vertical. Example: 1080
     * @bodyParam resolution_width int required Nueva resolución horizontal. Example: 1920
     * @bodyParam type string required Tipo actualizado (indoor u outdoor). Example: indoor
     *
     * @response 200 {
     *   "id": 1,
     *   "name": "Pantalla Actualizada",
     *   "description": "Descripción actualizada de la pantalla",
     *   "price_per_day": 150.75,
     *   "resolution_height": 1080,
     *   "resolution_width": 1920,
     *   "type": "indoor",
     *   "user_id": 2,
     *   "created_at": "2025-06-10T12:00:00Z",
     *   "updated_at": "2025-06-17T12:00:00Z"
     * }
     */
    public function update(UpdateDisplayRequest $request, $id)
    {
        $display = Display::findOrFail($id);

        $this->authorize('update', $display);

        $display->update($request->validated());

        return response()->json($display);
    }


    /**
     * Eliminar un Display
     *
     * Elimina un display existente del sistema.
     *
     * @group Displays
     * @authenticated
     * @header Authorization Bearer {token}
     *
     * @urlParam id integer required ID del display. Example: 1
     *
     * @response 200 {
     *   "message": "Display eliminado correctamente."
     * }
     *
     * @response 404 {
     *   "message": "Display no encontrado."
     * }
     */
    public function destroy($id)
    {
        $display = Display::find($id);
        if (!$display) {
            return response()->json(['message' => __('display.not_found')], 404);
        }

        $this->authorize('delete', $display);

        $display->delete();

        return response()->json(['message' => __('display.deleted')]);
    }
}
