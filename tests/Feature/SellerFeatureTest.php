<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Category;

test('seller can view seller dashboard', function () {
    $seller = User::factory()->seller()->create();
    
    $response = $this->actingAs($seller)
        ->get('/seller/products');
    
    $response->assertStatus(200);
})->group('seller');

test('non-seller cannot access seller dashboard', function () {
    $customer = User::factory()->customer()->create();
    
    $response = $this->actingAs($customer)
        ->get('/seller/products');
    
    $response->assertStatus(302); // Redirected
})->group('seller');

test('authenticated user can access account settings', function () {
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)
        ->get('/settings/account');
    
    $response->assertStatus(200);
})->group('settings');

test('guest cannot access seller dashboard', function () {
    $response = $this->get('/seller/products');
    
    $response->assertStatus(302); // Redirected to login
})->group('seller');

test('guest cannot access account settings', function () {
    $response = $this->get('/settings/account');
    
    $response->assertStatus(302); // Redirected to login
})->group('settings');
