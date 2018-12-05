<?php

namespace CHG\Voyager\Widgets;

use App\Models\Member\Points\Points;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use CHG\Voyager\Facades\Voyager;

class MemberPointDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Points::count();
        $string = $count == 1 ? 'Point' : 'Points';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-dollar',
            'title'  => "{$count} {$string}",
            'text'   => "{$count} {$string} in database. Click on button to view all {$string}",
            'button' => [
                'text' => "View all {$string}",
                'link' => route('voyager.crm-member-points.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', app(Points::class));
    }
}