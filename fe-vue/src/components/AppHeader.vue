<template>
  <header class="pc-header">
    <div class="header-wrapper">
      <!-- [Mobile Media Block] start -->
      <div class="me-auto pc-mob-drp">
        <ul class="list-unstyled">
          <!-- ======= Menu collapse Icon ===== -->
          <li class="pc-h-item pc-sidebar-collapse">
            <span @click="toggleSidebar" class="pc-head-link ms-0" id="sidebar-hide">
              <i class="ti ti-menu-2"></i>
            </span>
          </li>
          <li class="pc-h-item pc-sidebar-popup">
            <span @click="toggleSidebarMobile" class="pc-head-link ms-0" id="mobile-collapse">
              <i class="ti ti-menu-2"></i>
            </span>
          </li>
        </ul>
      </div>
      <!-- [Mobile Media Block end] -->
      <div class="ms-auto">
        <ul class="list-unstyled">
          <li class="dropdown pc-h-item">
            <a
              class="pc-head-link dropdown-toggle arrow-none me-0"
              data-bs-toggle="dropdown"
              href="#"
              role="button"
              aria-haspopup="false"
              aria-expanded="false"
            >
              <i>
                <svg class="pc-icon"><use xlink:href="#mail"></use></svg>
              </i>
            </a>
            <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
              <div class="dropdown-header d-flex align-items-center justify-content-between">
                <h5 class="m-0">Message</h5>
                <a href="#!" class="pc-head-link bg-transparent"
                  ><i class="ti ti-x text-danger"></i
                ></a>
              </div>
              <div class="dropdown-divider"></div>
              <div
                class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                style="max-height: calc(100vh - 215px)"
              >
                <div class="list-group list-group-flush w-100">
                  <a class="list-group-item list-group-item-action">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <img
                          src="/assets/images/user/avatar-2.jpg"
                          alt="user-image"
                          class="user-avtar"
                        />
                      </div>
                      <div class="flex-grow-1 ms-1">
                        <span class="float-end text-muted">3:00 AM</span>
                        <p class="text-body mb-1">It's <b>Cristina danny's</b> birthday today.</p>
                        <span class="text-muted">2 min ago</span>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="dropdown-divider"></div>
              <div class="text-center py-2">
                <a href="#!" class="link-primary">View all</a>
              </div>
            </div>
          </li>
          <li class="dropdown pc-h-item header-user-profile">
            <a
              class="pc-head-link dropdown-toggle arrow-none me-0"
              data-bs-toggle="dropdown"
              href="#"
              role="button"
              aria-haspopup="false"
              data-bs-auto-close="outside"
              aria-expanded="false"
            >
              <img src="/assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar" />
              <span>{{ authStore.user?.name }}</span>
            </a>
            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
              <div class="dropdown-header">
                <div class="d-flex mb-1">
                  <div class="flex-shrink-0">
                    <img
                      src="/assets/images/user/avatar-2.jpg"
                      alt="user-image"
                      class="user-avtar wid-35"
                    />
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h6 class="mb-1">{{ authStore.user?.name }}</h6>
                    <span>{{ authStore.user?.email }}</span>
                  </div>
                  <button
                    type="button"
                    @click="handleLogout"
                    class="pc-head-link bg-transparent btn"
                  >
                    <i class="ti ti-power text-danger"></i>
                  </button>
                </div>
              </div>
              <div
                class="tab-pane fade show active"
                id="drp-tab-1"
                role="tabpanel"
                aria-labelledby="drp-t1"
                tabindex="0"
              >
                <button type="button" @click="handleLogout" class="dropdown-item">
                  <i class="ti ti-power"></i>
                  <span>Logout</span>
                </button>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </header>
</template>
<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'
import { inject } from 'vue'
const authStore = useAuthStore()
const router = useRouter()

const toggleSidebar = inject<() => void>('toggleSidebar')

const toggleSidebarMobile = inject<() => void>('toggleSidebarMobile')

// Refs untuk mengakses elemen HTML
// const sidebar = ref<HTMLElement | null>(null)
// const sidebarHide = ref<HTMLElement | null>(null)

// onMounted(() => {
//   if (sidebarHide.value && sidebar.value) {
//     sidebarHide.value.addEventListener('click', () => {
//       sidebar.value?.classList.toggle('pc-sidebar-hide')
//     })
//   }
// })

const handleLogout = () => {
  authStore.logout()
  router.push('/login')
}
</script>
