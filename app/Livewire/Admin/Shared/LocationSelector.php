<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Shared;

use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Models\Locality;
use App\Models\Province;
use Illuminate\View\View;
use Livewire\Component;

class LocationSelector extends Component
{
    public $withArea     = true;
    public $withLocality = true;

    public $countries;
    public $countryId;
    public $provinces;
    public $provinceId;
    public $cities;
    public $cityId;

    public $areas;
    public $areaId;

    public $localities;
    public $localityId;

    public function mount($countryId = null, $provinceId = null, $cityId = null, $areaId = null): void
    {
        $this->countries = Country::active()->get();

        if ($countryId) {
            $this->provinces = Province::active()->where('country_id', $countryId)->get();
        } else {
            $this->provinces = collect();
        }

        if ($provinceId) {
            $this->cities = City::active()->where('province_id', $provinceId)->get();
        } else {
            $this->cities = collect();
        }

        if ($cityId) {
            $this->areas = Area::where('city_id', $cityId)->get();
        } else {
            $this->areas = collect();
        }

        if ($areaId) {
            $this->localities = Locality::where('area_id', $areaId)->get();
        } else {
            $this->localities = collect();
        }
    }

    public function updatedCountryId(): void
    {
        $this->provinces = Province::active()->where('country_id', $this->countryId)->get();
        $this->reset('provinceId', 'cityId', 'areaId', 'localityId');
    }

    public function updatedProvinceId(): void
    {
        $this->cities = City::active()->where('province_id', $this->provinceId)->get();
        $this->reset('cityId', 'areaId', 'localityId');
    }

    public function updatedCityId(): void
    {
        $this->areas = Area::where('city_id', $this->cityId)->get();
        $this->reset('areaId', 'localityId');
    }

    public function updatedAreaId(): void
    {
        $this->localities = Locality::where('area_id', $this->areaId)->get();
        $this->reset('localityId');
    }

    public function render(): View
    {
        return view('livewire.admin.shared.location-selector');
    }
}
