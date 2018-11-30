<?php

namespace CHG\Voyager\Tests;

use Illuminate\Support\Facades\Auth;
use CHG\Voyager\Facades\Voyager;
use CHG\Voyager\Models\Permission;
use CHG\Voyager\Models\Role;

class PermissionTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Auth::loginUsingId(1);
    }

    public function testPermissionNotExisting()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Permission does not exist');

        Voyager::can('test');
    }

    public function testNotHavingPermission()
    {
        Permission::create(['key' => 'test']);

        $this->assertFalse(Voyager::can('test'));
    }

    public function testHavingPermission()
    {
        $role = Role::find(1)
            ->permissions()
            ->create(['key' => 'test']);

        $this->assertTrue(Voyager::can('test'));
    }
}
