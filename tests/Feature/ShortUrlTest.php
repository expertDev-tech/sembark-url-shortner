<?php

use App\Models\Company;
use App\Models\ShortUrl;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;

beforeEach(function () {
    $this->seed([
        PermissionSeeder::class,
        RoleSeeder::class,
    ]);
});

test('admin can create short url', function () {

    $company = Company::factory()->create();

    $admin = User::factory()->create([
        'company_id' => $company->id,
    ]);

    $admin->assignRole('Admin');

    $response = $this
        ->actingAs($admin)
        ->post(route('short-urls.store'), [
            'original_url' => 'https://google.com',
        ]);

    $response->assertRedirect(
        route('short-urls.index')
    );

    $this->assertDatabaseHas('short_urls', [
        'user_id' => $admin->id,
        'company_id' => $company->id,
        'original_url' => 'https://google.com',
    ]);
});

test('member can create short url', function () {

    $company = Company::factory()->create();

    $member = User::factory()->create([
        'company_id' => $company->id,
    ]);

    $member->assignRole('Member');

    $response = $this
        ->actingAs($member)
        ->post(route('short-urls.store'), [
            'original_url' => 'https://laravel.com',
        ]);

    $response->assertRedirect(
        route('short-urls.index')
    );

    $this->assertDatabaseHas('short_urls', [
        'user_id' => $member->id,
        'company_id' => $company->id,
        'original_url' => 'https://laravel.com',
    ]);
});

test('super admin cannot create short url', function () {

    $superAdmin = User::factory()->create();

    $superAdmin->assignRole('SuperAdmin');

    $response = $this
        ->actingAs($superAdmin)
        ->get(route('short-urls.create'));

    $response->assertForbidden();
});