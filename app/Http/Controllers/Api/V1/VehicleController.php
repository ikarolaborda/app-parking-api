<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleStoreRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehicleController extends Controller
{
    public function __construct(protected VehicleService $service)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return VehicleResource::collection($this->service->all());
    }

    public function store(VehicleStoreRequest $request): VehicleResource
    {
        return new VehicleResource($this->service->create($request->validated()));
    }

    public function show(Vehicle $vehicle): VehicleResource
    {
        return new VehicleResource($this->service->find('id', $vehicle->id));
    }

    public function update(VehicleStoreRequest $request, Vehicle $vehicle): VehicleResource
    {
        return new VehicleResource($this->service->update($vehicle->id, $request->validated()));
    }

    public function destroy(Vehicle $vehicle): JsonResponse
    {
        return response()->json(['message' => $this->service->delete($vehicle->id) ? 'Vehicle deleted successfully' : 'Vehicle not found'],204);
    }
}
