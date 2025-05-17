<?php

namespace App\Helpers;

use App\Models\Category;

class CategoryHelper
{
    public static function getCategoriesTree($parentId = null, $allCategories = null)
    {
        // Fetch all categories once if not already provided
        if ($allCategories === null) {
            $allCategories = Category::all()->groupBy('parent_id');
        }

        $categories = $allCategories->get($parentId, []);
        $categoryTree = [];

        foreach ($categories as $category) {
            $children = self::getCategoriesTree($category->id, $allCategories);
            $categoryTree[] = [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'children' => $children,
            ];
        }

        return $categoryTree;
    }

    public static function getAllCategories()
    {
        return self::getCategoriesTree();
    }
}