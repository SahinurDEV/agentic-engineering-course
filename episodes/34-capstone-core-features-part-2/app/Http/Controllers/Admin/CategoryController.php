<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    /**
     * Every category, archived ones included, with its ticket count (R12).
     */
    public function index(): Response
    {
        return Inertia::render('admin/categories', [
            'categories' => Category::query()
                ->withCount('tickets')
                ->orderBy('name')
                ->get()
                ->map(fn (Category $category) => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'archived' => $category->archived_at !== null,
                    'tickets_count' => $category->tickets_count,
                ]),
        ]);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Category created.')]);

        return to_route('admin.categories.index');
    }

    /**
     * Rename. Tickets keep their category; only the name changes.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Category renamed.')]);

        return to_route('admin.categories.index');
    }

    /**
     * Archive: no new tickets can pick it; existing tickets keep it.
     */
    public function archive(Category $category): RedirectResponse
    {
        $category->archive();

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Category archived.')]);

        return to_route('admin.categories.index');
    }
}
