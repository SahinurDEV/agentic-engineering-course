# Episode 33: edits and excerpts

Changes to existing files, and summarised versions of longer files, as shown in this episode (copied from the episode script). The full files are in this folder where available and in [capstone/support-desk](../../capstone/support-desk) for the final app.

## `routes/web.php` (edits)

```diff
diff --git a/routes/web.php b/routes/web.php
index 2085b21..da7ee87 100644
--- a/routes/web.php
+++ b/routes/web.php
@@ -1,11 +1,28 @@
 <?php
 
+use App\Http\Controllers\InboxController;
+use App\Http\Controllers\ReplyController;
+use App\Http\Controllers\TicketController;
+use App\Models\Ticket;
 use Illuminate\Support\Facades\Route;
 
 Route::inertia('/', 'welcome')->name('home');
 
 Route::middleware(['auth', 'verified'])->group(function () {
     Route::inertia('dashboard', 'dashboard')->name('dashboard');
+
+    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
+    Route::get('tickets/create', [TicketController::class, 'create'])
+        ->can('create', Ticket::class)->name('tickets.create');
+    Route::post('tickets', [TicketController::class, 'store'])
+        ->can('create', Ticket::class)->name('tickets.store');
+    Route::get('tickets/{ticket}', [TicketController::class, 'show'])
+        ->can('view', 'ticket')->name('tickets.show');
+    Route::post('tickets/{ticket}/replies', [ReplyController::class, 'store'])
+        ->can('reply', 'ticket')->name('tickets.replies.store');
+
+    Route::get('inbox', InboxController::class)
+        ->can('viewAny', Ticket::class)->name('inbox');
 });
 
 require __DIR__.'/settings.php';
```

## `app/Http/Middleware/HandleInertiaRequests.php` and `app/Models/Ticket.php` (edits)

```diff
diff --git a/app/Http/Middleware/HandleInertiaRequests.php b/app/Http/Middleware/HandleInertiaRequests.php
index f4cc770..8a53d36 100644
--- a/app/Http/Middleware/HandleInertiaRequests.php
+++ b/app/Http/Middleware/HandleInertiaRequests.php
@@ -2,6 +2,7 @@
 
 namespace App\Http\Middleware;
 
+use App\Models\Ticket;
 use Illuminate\Http\Request;
 use Inertia\Middleware;
 
@@ -40,6 +41,10 @@ public function share(Request $request): array
             'name' => config('app.name'),
             'auth' => [
                 'user' => $request->user(),
+                'can' => [
+                    'openTicket' => (bool) $request->user()?->can('create', Ticket::class),
+                    'viewInbox' => (bool) $request->user()?->can('viewAny', Ticket::class),
+                ],
             ],
             'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
         ];
diff --git a/app/Models/Ticket.php b/app/Models/Ticket.php
index 2605e24..01e50b6 100644
--- a/app/Models/Ticket.php
+++ b/app/Models/Ticket.php
@@ -21,6 +21,7 @@
  * @property string $description
  * @property TicketStatus $status
  * @property TicketPriority $priority
+ * @property int $customer_id
  * @property int|null $assignee_id
  */
 #[Fillable(['subject', 'description', 'category_id'])]
```

## `resources/js/components/app-sidebar.tsx`, `resources/js/types/auth.ts`, `resources/js/types/index.ts` (edits)

```diff
diff --git a/resources/js/components/app-sidebar.tsx b/resources/js/components/app-sidebar.tsx
index a38aa1d..2d4d06f 100644
--- a/resources/js/components/app-sidebar.tsx
+++ b/resources/js/components/app-sidebar.tsx
@@ -1,5 +1,5 @@
-import { Link } from '@inertiajs/react';
-import { BookOpen, FolderGit2, LayoutGrid } from 'lucide-react';
+import { Link, usePage } from '@inertiajs/react';
+import { BookOpen, FolderGit2, Inbox, LayoutGrid, Ticket } from 'lucide-react';
 import AppLogo from '@/components/app-logo';
 import { NavFooter } from '@/components/nav-footer';
 import { NavMain } from '@/components/nav-main';
@@ -13,16 +13,15 @@ import {
     SidebarMenuButton,
     SidebarMenuItem,
 } from '@/components/ui/sidebar';
-import { dashboard } from '@/routes';
+import { dashboard, inbox } from '@/routes';
+import { index as tickets } from '@/routes/tickets';
 import type { NavItem } from '@/types';
 
-const mainNavItems: NavItem[] = [
-    {
-        title: 'Dashboard',
-        href: dashboard(),
-        icon: LayoutGrid,
-    },
-];
+const dashboardItem: NavItem = {
+    title: 'Dashboard',
+    href: dashboard(),
+    icon: LayoutGrid,
+};
 
 const footerNavItems: NavItem[] = [
     {
@@ -38,6 +37,17 @@ const footerNavItems: NavItem[] = [
 ];
 
 export function AppSidebar() {
+    const { auth } = usePage().props;
+    const mainNavItems: NavItem[] = [
+        dashboardItem,
+        ...(auth.can.openTicket
+            ? [{ title: 'My tickets', href: tickets(), icon: Ticket }]
+            : []),
+        ...(auth.can.viewInbox
+            ? [{ title: 'Inbox', href: inbox(), icon: Inbox }]
+            : []),
+    ];
+
     return (
         <Sidebar collapsible="icon" variant="inset">
             <SidebarHeader>
diff --git a/resources/js/types/auth.ts b/resources/js/types/auth.ts
index 0a17aec..1913494 100644
--- a/resources/js/types/auth.ts
+++ b/resources/js/types/auth.ts
@@ -12,6 +12,10 @@ export type User = {
 
 export type Auth = {
     user: User;
+    can: {
+        openTicket: boolean;
+        viewInbox: boolean;
+    };
 };
 
 export type Passkey = {
diff --git a/resources/js/types/index.ts b/resources/js/types/index.ts
index b1f0ee6..ff7d2dc 100644
--- a/resources/js/types/index.ts
+++ b/resources/js/types/index.ts
@@ -1,3 +1,4 @@
 export type * from './auth';
 export type * from './navigation';
+export type * from './tickets';
 export type * from './ui';
```

