<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public $data, $areas;

    public function index($id = null)
    {
        Cache::remember('covid19', Carbon::parse('1 minute'), function () {
            $this->data = Http::get('https://bing.com/covid/data')->json();
        });

        if ($id && isset($this->data['areas'])) {
            foreach ($this->data['areas'] as $data) {
                if ($id == $data['id'])
                    $this->data = $data;
            }
        }

        if (isset($this->data['areas'])) {
            $this->areas = $this->data['areas'];
        } else {
            $this->areas = [];
        }

        return view('home', [
            'id' => $id,
            'displayName' => $this->data['displayName'],
            'totalConfirmed' => $this->data['totalConfirmed'],
            'totalRecovered' => $this->data['totalRecovered'],
            'totalDeaths' => $this->data['totalDeaths'],
            'areas' => $this->areas
        ]);
    }
}
