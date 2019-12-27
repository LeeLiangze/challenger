<?php

namespace CHG\Voyager\Events;

use Illuminate\Queue\SerializesModels;
use CHG\Voyager\Models\Setting;

class SettingUpdated
{
    use SerializesModels;

    public $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
}
