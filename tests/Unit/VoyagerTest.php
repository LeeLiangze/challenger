<?php

namespace CHG\Voyager\Tests\Unit;

use Illuminate\Support\Facades\Config;
use CHG\Voyager\Facades\Voyager;
use CHG\Voyager\Tests\TestCase;

class VoyagerTest extends TestCase
{
    /**
     * Dimmers returns collection of widgets.
     *
     * This test will make sure that the dimmers method will give us a
     * collection of the configured widgets.
     */
    public function testDimmersReturnsCollectionOfConfiguredWidgets()
    {
        Config::set('voyager.dashboard.widgets', [
            'CHG\\Voyager\\Tests\\Stubs\\Widgets\\AccessibleDimmer',
            'CHG\\Voyager\\Tests\\Stubs\\Widgets\\AccessibleDimmer',
        ]);

        $dimmers = Voyager::dimmers();

        $this->assertEquals(2, $dimmers->count());
    }

    /**
     * Dimmers returns collection of widgets which should be displayed.
     *
     * This test will make sure that the dimmers method will give us a
     * collection of the configured widgets which also should be displayed.
     */
    public function testDimmersReturnsCollectionOfConfiguredWidgetsWhichShouldBeDisplayed()
    {
        Config::set('voyager.dashboard.widgets', [
            'CHG\\Voyager\\Tests\\Stubs\\Widgets\\AccessibleDimmer',
            'CHG\\Voyager\\Tests\\Stubs\\Widgets\\InAccessibleDimmer',
            'CHG\\Voyager\\Tests\\Stubs\\Widgets\\InAccessibleDimmer',
        ]);

        $dimmers = Voyager::dimmers();

        $this->assertEquals(1, $dimmers->count());
    }
}
