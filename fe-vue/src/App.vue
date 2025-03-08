<script setup lang="ts">
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/css/index.css'

import { RouterView } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()
</script>

<template>
  <div v-if="authStore.isLoading">
    <div class="vl-parent">
      <loading
        v-model:active="authStore.isLoading"
        :can-cancel="true"
        :opacity="0.5"
        :is-full-page="true"
      />
    </div>
  </div>
  <div v-else>
    <RouterView />
  </div>
</template>
