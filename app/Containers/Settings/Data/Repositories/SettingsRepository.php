<?php

namespace App\Containers\Settings\Data\Repositories;

use App\Containers\Settings\Models\Settings;
use App\Ship\Parents\Repositories\Repository;

/**
 * Class SettingsRepository
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class SettingsRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * @return  mixed
     */
    public function model()
    {
        return Settings::class;
    }
}
