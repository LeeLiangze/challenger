<?php

namespace CHG\Voyager\Widgets;

use App\Models\Member\Voucher\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use CHG\Voyager\Facades\Voyager;

class MemberVoucherDimmer extends BaseDimmer
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
        $count = Voucher::count();
        $string = $count == 1 ? 'Voucher' : 'Vouchers';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-file-text',
            'title'  => "{$count} {$string}",
            'text'   => "{$count} {$string} in database. Click on button to view all {$string}",
            'button' => [
                'text' => "View all {$string}",
                'link' => route('voyager.crm-voucher-list.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/07.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', app(Voucher::class));
    }
}