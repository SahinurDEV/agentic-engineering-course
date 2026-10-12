# Episode 34: edits and excerpts

Changes to existing files, and summarised versions of longer files, as shown in this episode (copied from the episode script). The full files are in this folder where available and in [capstone/support-desk](../../capstone/support-desk) for the final app.

## `docs/requirements.md` and `tsconfig.json` (edits on main, before both branches)

```diff
diff --git a/docs/requirements.md b/docs/requirements.md
index 3b8eed3..5626bbd 100644
--- a/docs/requirements.md
+++ b/docs/requirements.md
@@ -45,3 +45,8 @@ ## Out of scope for v1
 
 ## Done means
 A requirement is done when its spec is archived into openspec/specs, its tests pass in CI, and its pull request is reviewed and merged.
+
+## Decisions
+D1 Search covers subjects and public replies only. Internal notes are not searched (R6).
+D2 The last admin keeps the admin role. A role change that would leave no admin is refused (R12).
+D3 Customers do not edit a ticket after opening it, including its category. They can say so in a reply.
diff --git a/tsconfig.json b/tsconfig.json
index ca07426..7de4937 100644
--- a/tsconfig.json
+++ b/tsconfig.json
@@ -116,5 +116,7 @@
         "resources/js/**/*.ts",
         "resources/js/**/*.d.ts",
         "resources/js/**/*.tsx"
-    ]
+    ],
+    // Wayfinder generates these for Route::redirect; their "query" method is not in its Method type yet.
+    "exclude": ["resources/js/actions/Illuminate"]
 }
```

## `routes/web.php` (edits, both branches, after the merge)

```diff
diff --git a/routes/web.php b/routes/web.php
index da7ee87..e3dcb3a 100644
--- a/routes/web.php
+++ b/routes/web.php
@@ -1,9 +1,15 @@
 <?php
 
+use App\Http\Controllers\Admin\CategoryController;
+use App\Http\Controllers\Admin\UserController;
 use App\Http\Controllers\InboxController;
+use App\Http\Controllers\NoteController;
 use App\Http\Controllers\ReplyController;
 use App\Http\Controllers\TicketController;
+use App\Http\Controllers\TicketUpdateController;
+use App\Models\Category;
 use App\Models\Ticket;
+use App\Models\User;
 use Illuminate\Support\Facades\Route;
 
 Route::inertia('/', 'welcome')->name('home');
@@ -18,11 +24,31 @@
         ->can('create', Ticket::class)->name('tickets.store');
     Route::get('tickets/{ticket}', [TicketController::class, 'show'])
         ->can('view', 'ticket')->name('tickets.show');
+    Route::patch('tickets/{ticket}', TicketUpdateController::class)
+        ->can('update', 'ticket')->name('tickets.update');
     Route::post('tickets/{ticket}/replies', [ReplyController::class, 'store'])
         ->can('reply', 'ticket')->name('tickets.replies.store');
+    Route::post('tickets/{ticket}/notes', [NoteController::class, 'store'])
+        ->can('addNote', 'ticket')->name('tickets.notes.store');
 
     Route::get('inbox', InboxController::class)
         ->can('viewAny', Ticket::class)->name('inbox');
+
+    Route::prefix('admin')->name('admin.')->group(function () {
+        Route::get('categories', [CategoryController::class, 'index'])
+            ->can('viewAny', Category::class)->name('categories.index');
+        Route::post('categories', [CategoryController::class, 'store'])
+            ->can('create', Category::class)->name('categories.store');
+        Route::patch('categories/{category}', [CategoryController::class, 'update'])
+            ->can('update', 'category')->name('categories.update');
+        Route::post('categories/{category}/archive', [CategoryController::class, 'archive'])
+            ->can('update', 'category')->name('categories.archive');
+
+        Route::get('users', [UserController::class, 'index'])
+            ->can('viewAny', User::class)->name('users.index');
+        Route::patch('users/{user}/role', [UserController::class, 'updateRole'])
+            ->can('updateRole', 'user')->name('users.role');
+    });
 });
 
 require __DIR__.'/settings.php';
```

## `app/Models/Ticket.php`, `app/Models/Category.php`, `app/Http/Middleware/HandleInertiaRequests.php`, `app/Http/Requests/StoreTicketRequest.php` (edits)

```diff
diff --git a/app/Http/Middleware/HandleInertiaRequests.php b/app/Http/Middleware/HandleInertiaRequests.php
index 8a53d36..a8f1faf 100644
--- a/app/Http/Middleware/HandleInertiaRequests.php
+++ b/app/Http/Middleware/HandleInertiaRequests.php
@@ -2,7 +2,9 @@
 
 namespace App\Http\Middleware;
 
+use App\Models\Category;
 use App\Models\Ticket;
+use App\Models\User;
 use Illuminate\Http\Request;
 use Inertia\Middleware;
 
@@ -44,6 +46,8 @@ public function share(Request $request): array
                 'can' => [
                     'openTicket' => (bool) $request->user()?->can('create', Ticket::class),
                     'viewInbox' => (bool) $request->user()?->can('viewAny', Ticket::class),
+                    'manageCategories' => (bool) $request->user()?->can('viewAny', Category::class),
+                    'manageUsers' => (bool) $request->user()?->can('viewAny', User::class),
                 ],
             ],
             'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
diff --git a/app/Http/Requests/StoreTicketRequest.php b/app/Http/Requests/StoreTicketRequest.php
index 9a271c1..e3d7fa9 100644
--- a/app/Http/Requests/StoreTicketRequest.php
+++ b/app/Http/Requests/StoreTicketRequest.php
@@ -4,6 +4,7 @@
 
 use Illuminate\Contracts\Validation\ValidationRule;
 use Illuminate\Foundation\Http\FormRequest;
+use Illuminate\Validation\Rule;
 
 class StoreTicketRequest extends FormRequest
 {
@@ -23,7 +24,11 @@ public function rules(): array
         return [
             'subject' => ['required', 'string', 'max:255'],
             'description' => ['required', 'string', 'max:10000'],
-            'category_id' => ['required', 'integer', 'exists:categories,id'],
+            'category_id' => [
+                'required',
+                'integer',
+                Rule::exists('categories', 'id')->whereNull('archived_at'),
+            ],
         ];
     }
 }
diff --git a/app/Models/Category.php b/app/Models/Category.php
index f18ae12..f02837e 100644
--- a/app/Models/Category.php
+++ b/app/Models/Category.php
@@ -2,17 +2,20 @@
 
 namespace App\Models;
 
+use Carbon\CarbonImmutable;
 use Database\Factories\CategoryFactory;
 use Illuminate\Database\Eloquent\Attributes\Fillable;
+use Illuminate\Database\Eloquent\Attributes\Scope;
+use Illuminate\Database\Eloquent\Builder;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\HasMany;
-use Illuminate\Support\Carbon;
 
 /**
  * @property int $id
  * @property string $name
- * @property Carbon|null $archived_at
+ * @property CarbonImmutable|null $archived_at
+ * @property int|null $tickets_count
  */
 #[Fillable(['name'])]
 class Category extends Model
@@ -27,6 +30,26 @@ protected function casts(): array
         ];
     }
 
+    /**
+     * Categories that new tickets can pick (R12).
+     *
+     * @param  Builder<Category>  $query
+     */
+    #[Scope]
+    protected function active(Builder $query): void
+    {
+        $query->whereNull('archived_at');
+    }
+
+    /**
+     * Archived categories can't be picked for new tickets; existing tickets keep them.
+     */
+    public function archive(): void
+    {
+        $this->archived_at ??= now();
+        $this->save();
+    }
+
     /**
      * @return HasMany<Ticket, $this>
      */
diff --git a/app/Models/Ticket.php b/app/Models/Ticket.php
index 01e50b6..5d2ff9f 100644
--- a/app/Models/Ticket.php
+++ b/app/Models/Ticket.php
@@ -5,6 +5,7 @@
 use App\Enums\TicketPriority;
 use App\Enums\TicketStatus;
 use Database\Factories\TicketFactory;
+use DomainException;
 use Illuminate\Database\Eloquent\Attributes\Fillable;
 use Illuminate\Database\Eloquent\Attributes\Scope;
 use Illuminate\Database\Eloquent\Builder;
@@ -111,6 +112,27 @@ public function addReply(User $author, string $body): Reply
         return $reply;
     }
 
+    /**
+     * A public reply with the R10 rules: closed tickets take no replies, and a
+     * customer reply on a pending or resolved ticket sets it to open (logged).
+     */
+    public function respond(User $author, string $body): Reply
+    {
+        if ($this->status === TicketStatus::Closed) {
+            throw new DomainException('Closed tickets take no replies.');
+        }
+
+        return DB::transaction(function () use ($author, $body) {
+            $reply = $this->addReply($author, $body);
+
+            if (! $author->isAgent() && in_array($this->status, [TicketStatus::Pending, TicketStatus::Resolved], true)) {
+                $this->changeStatus($author, TicketStatus::Open);
+            }
+
+            return $reply;
+        });
+    }
+
     public function addNote(User $author, string $body): InternalNote
     {
         if (! $author->isAgent()) {
```

## `resources/js/components/app-sidebar.tsx` and `resources/js/types` (edits)

```diff
diff --git a/resources/js/components/app-sidebar.tsx b/resources/js/components/app-sidebar.tsx
index 2d4d06f..ed8a566 100644
--- a/resources/js/components/app-sidebar.tsx
+++ b/resources/js/components/app-sidebar.tsx
@@ -1,5 +1,13 @@
 import { Link, usePage } from '@inertiajs/react';
-import { BookOpen, FolderGit2, Inbox, LayoutGrid, Ticket } from 'lucide-react';
+import {
+    BookOpen,
+    FolderGit2,
+    Inbox,
+    LayoutGrid,
+    Tags,
+    Ticket,
+    Users,
+} from 'lucide-react';
 import AppLogo from '@/components/app-logo';
 import { NavFooter } from '@/components/nav-footer';
 import { NavMain } from '@/components/nav-main';
@@ -14,6 +22,8 @@ import {
     SidebarMenuItem,
 } from '@/components/ui/sidebar';
 import { dashboard, inbox } from '@/routes';
+import { index as categories } from '@/routes/admin/categories';
+import { index as users } from '@/routes/admin/users';
 import { index as tickets } from '@/routes/tickets';
 import type { NavItem } from '@/types';
 
@@ -46,6 +56,12 @@ export function AppSidebar() {
         ...(auth.can.viewInbox
             ? [{ title: 'Inbox', href: inbox(), icon: Inbox }]
             : []),
+        ...(auth.can.manageCategories
+            ? [{ title: 'Categories', href: categories(), icon: Tags }]
+            : []),
+        ...(auth.can.manageUsers
+            ? [{ title: 'Users', href: users(), icon: Users }]
+            : []),
     ];
 
     return (
diff --git a/resources/js/types/auth.ts b/resources/js/types/auth.ts
index 1913494..b305c99 100644
--- a/resources/js/types/auth.ts
+++ b/resources/js/types/auth.ts
@@ -15,6 +15,8 @@ export type Auth = {
     can: {
         openTicket: boolean;
         viewInbox: boolean;
+        manageCategories: boolean;
+        manageUsers: boolean;
     };
 };
```

