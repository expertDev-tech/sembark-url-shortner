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

test('admin sees only company urls', function () {

    $companyA = Company::factory()->create();
    $companyB = Company::factory()->create();

    $admin = User::factory()->create([
        'company_id' => $companyA->id,
    ]);

    $admin->assignRole('Admin');

    $userA = User::factory()->create([
        'company_id' => $companyA->id,
    ]);

    $userB = User::factory()->create([
        'company_id' => $companyB->id,
    ]);

    $companyUrl = ShortUrl::factory()->create([
        'company_id' => $companyA->id,
        'user_id' => $userA->id,
    ]);

    $otherCompanyUrl = ShortUrl::factory()->create([
        'company_id' => $companyB->id,
        'user_id' => $userB->id,
    ]);

    $response = $this
        ->actingAs($admin)
        ->get(route('short-urls.index'));

    $response->assertSee($companyUrl->short_code);

    $response->assertDontSee(
        $otherCompanyUrl->short_code
    );
});

test('member sees only own urls', function () {

    $company = Company::factory()->create();

    $member = User::factory()->create([
        'company_id' => $company->id,
    ]);

    $member->assignRole('Member');

    $anotherMember = User::factory()->create([
        'company_id' => $company->id,
    ]);

    $ownUrl = ShortUrl::factory()->create([
        'company_id' => $company->id,
        'user_id' => $member->id,
    ]);

    $otherUrl = ShortUrl::factory()->create([
        'company_id' => $company->id,
        'user_id' => $anotherMember->id,
    ]);

    $response = $this
        ->actingAs($member)
        ->get(route('short-urls.index'));

    $response->assertSee($ownUrl->short_code);

    $response->assertDontSee(
        $otherUrl->short_code
    );
});

test('short url redirects to original url', function () {

    $shortUrl = ShortUrl::factory()->create([
        'original_url' => 'https://google.com',
        'short_code' => 'abc123',
    ]);

    $response = $this->get('/s/abc123');

    $response->assertRedirect(
        'https://google.com'
    );
});

test('hits increment when short url is visited', function () {

    $shortUrl = ShortUrl::factory()->create([
        'hits' => 0,
        'short_code' => 'abc123',
    ]);

    $this->get('/s/abc123');

    expect(
        $shortUrl->fresh()->hits
    )->toBe(1);
});