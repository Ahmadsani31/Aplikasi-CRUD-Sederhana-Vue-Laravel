<template>
  <nav
    class="pc-sidebar"
    :class="{ 'pc-sidebar-hide': pcSidebar, 'mob-sidebar-active': pcSidebarMobile }"
  >
    <div class="navbar-wrapper">
      <div class="m-header">
        <a href="#" class="b-brand text-primary">
          <!-- ========   Change your logo from here   ============ -->
          <h3 class="fw-bold">VUE JS</h3>
        </a>
      </div>
      <div class="navbar-content">
        <ul class="pc-navbar">
          <li class="pc-item" :class="{ active: route.path === '/dashboard' }">
            <RouterLink to="/dashboard" class="pc-link">
              <span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#dashboard"></use>
                </svg>
              </span>
              <span class="pc-mtext">Dashboard</span>
            </RouterLink>
          </li>

          <li class="pc-item" :class="{ active: route.path === '/mahasiswa' }">
            <RouterLink to="/mahasiswa" class="pc-link">
              <span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#user"></use>
                </svg>
              </span>
              <span class="pc-mtext">Mahasiswa</span>
            </RouterLink>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script setup lang="ts">
import { inject } from 'vue'
import type { Ref } from 'vue'
import { RouterLink, useRoute } from 'vue-router'
const route = useRoute()
// Ambil menuState dari parent
const pcSidebar = inject<Ref<boolean>>('pcSidebar')
const pcSidebarMobile = inject<Ref<boolean>>('pcSidebarMobile')
</script>
