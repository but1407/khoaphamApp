<?php

namespace App\Http\Services\Slider;


use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function show()
    {
        return Slider::where('active', 1)->orderByDesc('sort_by')->get();
    }
}