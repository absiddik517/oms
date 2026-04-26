<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { BookOpen, Folder, ListChecks, House, ChartNoAxesCombined, User } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const page = usePage();
const user = page.props.auth.user;

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: route('dashboard'),
        icon: ChartNoAxesCombined,
        authorized: true,
    },
    {
        title: 'Offices',
        href: route('offices.index'),
        icon: House,
        authorized: user.role === 'admin',
    },
    {
        title: 'Officers',
        href: route('officers.index'),
        icon: User,
        authorized: true,
    },
    {
        title: 'Topics',
        href: route('topics.index'),
        icon: ListChecks,
        authorized: true,
    },
    {
        title: 'Folders',
        href: route('folders.index'),
        icon: Folder,
        authorized: true,
    },
    {
        title: 'Receipients',
        href: route('recipients.index'),
        icon: User,
        authorized: true,
    },
    {
        title: 'Letters',
        href: route('letters.index'),
        icon: BookOpen,
        authorized: true,
    },
    {
        title: 'Users',
        href: route('users.index'),
        icon: User,
        authorized: true,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/absiddik517/oms.git',
        icon: Folder,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
