<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkingStartRequest;
use App\Http\Requests\ParkingStopRequest;
use App\Http\Resources\ParkingResource;
use App\Models\Parking;
use App\Services\ParkingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ParkingController extends Controller
{
    public function __construct(protected ParkingService $parkingService)
    {
    }

    public function start(ParkingStartRequest $request): array | JsonResponse | AnonymousResourceCollection | ParkingResource
    {
        $parkingData = $request->validated();

        if($this->parkingService->getActiveParking((int)$parkingData['vehicle_id'])) {
            return response()->json([
                'errors' => ['general' => ['Can\'t start parking twice using same vehicle. Please stop currently active parking.']],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $parking = $this->parkingService->start($parkingData['vehicle_id'], $parkingData['zone_id']);
        $parking->load('vehicle', 'zone');
        return ParkingResource::make($parking);

    }

    public function stop(Parking $parking): ParkingResource
    {
        return $this->parkingService->stop($parking);
    }

    public function getActiveParking(): AnonymousResourceCollection
    {
        $parking = $this->parkingService->getActiveParkings();
        return ParkingResource::collection($parking);
    }

    public function getStoppedParking(): AnonymousResourceCollection
    {
        $parkings = $this->parkingService->getStoppedParkings();
        return ParkingResource::collection($parkings);
    }

    public function show(Parking $parking): array | JsonResponse | ParkingResource
    {

        return ParkingResource::make($parking);
    }

}
