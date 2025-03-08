<template>
  <!-- [ Sidebar Menu ] start -->
  <AppSidebar />
  <!-- [ Sidebar Menu ] end -->
  <!-- [ Header Topbar ] start -->
  <AppHeader />
  <!-- [ Header ] end -->

  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <router-view></router-view>
  </div>
  <!-- [ Main Content ] end -->
  <AppFooter />
</template>
<script setup lang="ts">
import { ref, provide } from 'vue'

import AppFooter from '@/components/AppFooter.vue'
import AppHeader from '@/components/AppHeader.vue'
import AppSidebar from '@/components/AppSidebar.vue'

const pcSidebar = ref<boolean>(false)
const pcSidebarMobile = ref<boolean>(false)

provide('pcSidebar', pcSidebar)
provide('pcSidebarMobile', pcSidebarMobile)

provide('toggleSidebar', () => {
  pcSidebar.value = !pcSidebar.value
})

provide('toggleSidebarMobile', () => {
  pcSidebarMobile.value = !pcSidebarMobile.value
})
</script>
