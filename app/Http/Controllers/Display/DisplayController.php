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
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     */
    public function store(StoreDisplayRequest $request)
    {
        $display = auth('api')->user()->displays()->create($request->validated());

        return response()->json($display, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $display = Display::findOrFail($id);

        $this->authorize('view', $display);

        return response()->json($display);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDisplayRequest $request, $id)
    {
        $display = Display::findOrFail($id);

        $this->authorize('update', $display);

        $display->update($request->validated());

        return response()->json($display);
    }


    /**
     * Remove the specified resource from storage.
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
