<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import Matric from '../components/ui/dashboard/Matric.vue';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Dashboard',
    href: '/dashboard',
  },
];

defineProps<{
  name?: string;
  offices: {
    count: number;
    change: string;
  };
  topics: {
    count: number;
    change: string;
  };
  inspire: String,

}>();
</script>



<template>

  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <div class="grid gap-4 md:grid-cols-3">
        <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
          <!-- Replace with actual content 1 -->
          <Matric :count="offices.count" :change="offices.change" title="Total Offices">
            <template #icon>
              <i class="fa fa-building"></i>
            </template>
          </Matric>
          <!-- End of dashboard state one-->
        </div>
        <div
          class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
          <!-- Replace with actual content 2 -->
          <Matric :count="topics.count" :change="topics.change" title="Total Topics">
            <template #icon>
              <i class="fa fa-file-alt"></i>
            </template>
          </Matric>
          <!-- End of dashboard state two-->
        </div>
        <div
          class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
          <div v-html="inspire"></div>
          <PlaceholderPattern />
        </div>
      </div>
      <div
        class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
        <PlaceholderPattern />
      </div>
    </div>
  </AppLayout>
</template>
