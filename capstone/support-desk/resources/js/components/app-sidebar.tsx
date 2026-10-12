import { Link, usePage } from '@inertiajs/react';
import {
    BookOpen,
    FolderGit2,
    Inbox,
    LayoutGrid,
    Tags,
    Ticket,
    Users,
} from 'lucide-react';
import AppLogo from '@/components/app-logo';
import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard, inbox } from '@/routes';
import { index as categories } from '@/routes/admin/categories';
import { index as users } from '@/routes/admin/users';
import { index as tickets } from '@/routes/tickets';
import type { NavItem } from '@/types';

const dashboardItem: NavItem = {
    title: 'Dashboard',
    href: dashboard(),
    icon: LayoutGrid,
};

const footerNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/laravel/react-starter-kit',
        icon: FolderGit2,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#react',
        icon: BookOpen,
    },
];

export function AppSidebar() {
    const { auth } = usePage().props;
    const mainNavItems: NavItem[] = [
        dashboardItem,
        ...(auth.can.openTicket
            ? [{ title: 'My tickets', href: tickets(), icon: Ticket }]
            : []),
        ...(auth.can.viewInbox
            ? [{ title: 'Inbox', href: inbox(), icon: Inbox }]
            : []),
        ...(auth.can.manageCategories
            ? [{ title: 'Categories', href: categories(), icon: Tags }]
            : []),
        ...(auth.can.manageUsers
            ? [{ title: 'Users', href: users(), icon: Users }]
            : []),
    ];

    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={dashboard()} prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
