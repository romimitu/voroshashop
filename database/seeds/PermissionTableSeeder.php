<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    
    public function run()
    {
        $permissions = [
            // 'role-list',
            // 'role-create',
            // 'role-edit',
            // 'role-delete',
            // 'user-list',
            // 'user-create',
            // 'user-edit',
            // 'user-delete',
            // 'size-list',
            // 'size-create',
            // 'size-edit',
            // 'size-delete',
            // 'shipment-list',
            // 'shipment-create',
            // 'shipment-edit',
            // 'shipment-delete',
            // 'product-list',
            // 'product-create',
            // 'product-edit',
            // 'product-delete',
            // 'order-list',
            // 'order-create',
            // 'order-edit',
            // 'order-delete',
            // 'color-list',
            // 'color-create',
            // 'color-edit',
            // 'color-delete',
            // 'category-list',
            // 'category-create',
            // 'category-edit',
            // 'category-delete',
            // 'brand-list',
            // 'brand-create',
            // 'brand-edit',
            // 'brand-delete',
            // 'blog-list',
            // 'blog-create',
            // 'blog-edit',
            // 'blog-delete',
            // 'supplier-list',
            // 'supplier-create',
            // 'supplier-edit',
            // 'supplier-delete',
            // 'purchase-list',
            // 'purchase-create',
            // 'purchase-edit',
            // 'purchase-delete',
            // 'about-list',
            // 'about-create',
            // 'about-edit',
            // 'about-delete',
            // 'report-list',
            // 'report-create',
            // 'report-edit',
            // 'report-delete',
            // 'purchasePayment-list',
            // 'purchasePayment-create',
            // 'purchasePayment-edit',
            // 'purchasePayment-delete',
            // 'dashboard-list'
            // 'chartOfAccount-list',
            // 'chartOfAccount-create',
            // 'chartOfAccount-edit',
            // 'chartOfAccount-delete',
            // 'transact-list',
            // 'transact-create',
            // 'transact-edit',
            // 'transact-delete',
        ];
 
 
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
