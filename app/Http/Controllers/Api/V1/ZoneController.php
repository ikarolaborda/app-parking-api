<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\ZoneService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ZoneController extends Controller
{
    public function __construct(protected ZoneService $zoneService)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return $this->zoneService->all();
    }
}
