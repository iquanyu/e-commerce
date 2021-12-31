<!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  const colors = require('tailwindcss/colors')
  
  module.exports = {
    // ...
    theme: {
      extend: {
        colors: {
          'blue-gray': colors.blueGray,
        },
      },
    },
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
  <!--
    This example requires updating your template:

    ```
    <html class="h-full bg-blue-gray-50">
    <body class="h-full overflow-hidden">
    ```
  -->
  <div class="h-full flex">
    <TransitionRoot as="template"
                    :show="mobileMenuOpen">
      <Dialog as="div"
              class="fixed inset-0 flex z-40 lg:hidden"
              @close="mobileMenuOpen = false">
        <TransitionChild as="template"
                         enter="transition-opacity ease-linear duration-300"
                         enter-from="opacity-0"
                         enter-to="opacity-100"
                         leave="transition-opacity ease-linear duration-300"
                         leave-from="opacity-100"
                         leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-blue-gray-600 bg-opacity-75" />
        </TransitionChild>
        <TransitionChild as="template"
                         enter="transition ease-in-out duration-300 transform"
                         enter-from="-translate-x-full"
                         enter-to="translate-x-0"
                         leave="transition ease-in-out duration-300 transform"
                         leave-from="translate-x-0"
                         leave-to="-translate-x-full">
          <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white focus:outline-none">
            <TransitionChild as="template"
                             enter="ease-in-out duration-300"
                             enter-from="opacity-0"
                             enter-to="opacity-100"
                             leave="ease-in-out duration-300"
                             leave-from="opacity-100"
                             leave-to="opacity-0">
              <div class="absolute top-0 right-0 -mr-12 pt-4">
                <button type="button"
                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        @click="mobileMenuOpen = false">
                  <span class="sr-only">Close sidebar</span>
                  <XIcon class="h-6 w-6 text-white"
                         aria-hidden="true" />
                </button>
              </div>
            </TransitionChild>
            <div class="pt-5 pb-4">
              <div class="flex-shrink-0 flex items-center px-4">
                <img class="h-8 w-auto"
                     src="https://tailwindui.com/img/logos/workflow-mark.svg?color=blue&shade=600"
                     alt="Workflow" />
              </div>
              <nav aria-label="Sidebar"
                   class="mt-5">
                <div class="px-2 space-y-1">

                  <Link v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        class="group p-2 rounded-md flex items-center text-base font-medium text-blue-gray-600 hover:bg-blue-gray-50 hover:text-blue-gray-900">
                  <component :is="item.icon"
                             class="mr-4 h-6 w-6 text-blue-gray-400 group-hover:text-blue-gray-500"
                             aria-hidden="true" />
                  {{ item.name }}
                  </Link>
                </div>
              </nav>
            </div>
            <div class="flex-shrink-0 flex border-t border-blue-gray-200 p-4">
              <a href="#"
                 class="flex-shrink-0 group block">
                <div class="flex items-center">
                  <div>
                    <img class="inline-block h-10 w-10 rounded-full"
                         src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2.5&w=256&h=256&q=80"
                         alt="" />
                  </div>
                  <div class="ml-3">
                    <p class="text-base font-medium text-blue-gray-700 group-hover:text-blue-gray-900">
                      Lisa Marie
                    </p>
                    <p class="text-sm font-medium text-blue-gray-500 group-hover:text-blue-gray-700">
                      Account Settings
                    </p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </TransitionChild>
        <div class="flex-shrink-0 w-14"
             aria-hidden="true">
          <!-- Force sidebar to shrink to fit close icon -->
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:flex lg:flex-shrink-0">
      <div class="flex flex-col w-24">
        <div class="flex-1 flex flex-col min-h-0 overflow-y-auto bg-white border-r">
          <div class="flex-1">
            <div class="bg-white py-4 flex items-center justify-center">
              <img class="h-8 w-auto"
                   src="https://tailwindui.com/img/logos/workflow-mark.svg"
                   alt="Workflow" />
            </div>
            <nav aria-label="Sidebar"
                 class="py-6 flex flex-col items-center space-y-1">
              <Link v-for="item in navigation"
                    :href="route(item.router)"
                    :key="item.name"
                    :class="[ isUrl(item.code) ? 'text-blue-600' : 'text-gray-500', 'flex flex-col items-center p-2 rounded']">
              <component :is="item.icon"
                         class="h-8 w-8"
                         aria-hidden="true" />
              <span class="">{{ item.name }}</span>
              </Link>
            </nav>
          </div>
          <div class="flex-shrink-0 flex pb-5 justify-center ">
            <div class="relative">
              <Menu>
                <MenuItems class="bg-gray-200 py-2 rounded-md">
                  <MenuItem v-slot="{ active }">
                  <a :class='{ "bg-blue-500": active }'
                     href="/account-settings">
                    Logout
                  </a>
                  </MenuItem>
                </MenuItems>
                <MenuButton v-if="$page.props.jetstream.managesProfilePhotos"
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                  <img class="h-12 w-12 rounded-full object-cover"
                       :src="$page.props.user.profile_photo_url"
                       :alt="$page.props.user.name" />
                </MenuButton>
              </Menu>
            </div>
            <!-- Settings Dropdown -->
            <!-- <div class="relative">
              <jet-dropdown align="top"
                            width="24">
                <template #trigger>
                  <button v-if="$page.props.jetstream.managesProfilePhotos"
                          class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                    <img class="h-12 w-12 rounded-full object-cover"
                         :src="$page.props.user.profile_photo_url"
                         :alt="$page.props.user.name" />
                  </button>

                  <span v-else
                        class="inline-flex rounded-md">
                    <button type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                      {{ $page.props.user.name }}

                      <svg class="ml-2 -mr-0.5 h-4 w-4"
                           xmlns="http://www.w3.org/2000/svg"
                           viewBox="0 0 20 20"
                           fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                      </svg>
                    </button>
                  </span>
                </template>

                <template #content>
            <div class="block px-4 py-2 text-xs text-gray-400">
              Manage Account
            </div>

            <jet-dropdown-link :href="route('profile.show')">
              Profile
            </jet-dropdown-link>

            <jet-dropdown-link :href="route('api-tokens.index')"
                               v-if="$page.props.jetstream.hasApiFeatures">
              API Tokens
            </jet-dropdown-link>

            <div class="border-t border-gray-100"></div>

            <form @submit.prevent="logout">
              <jet-dropdown-link as="button">
                Log Out
              </jet-dropdown-link>
            </form>
</template>
              </jet-dropdown>
            </div> -->
            <!-- <a href="#"
               class="flex-shrink-0 w-full">
              <img class="block mx-auto h-10 w-10 rounded-full"
                   src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2.5&w=256&h=256&q=80"
                   alt="" />
              <div class="sr-only">
                <p>
                  Lisa Marie
                </p>
                <p>
                  Account settings
                </p>
              </div>
            </a> -->
          </div>
        </div>
      </div>
    </div>

    <div class="flex-1 min-w-0 flex flex-col overflow-hidden">
      <!-- Mobile top navigation -->
      <div class="lg:hidden">
        <div class="bg-blue-600 py-2 px-4 flex items-center justify-between sm:px-6">
          <div>
            <img class="h-8 w-auto"
                 src="https://tailwindui.com/img/logos/workflow-mark.svg?color=white"
                 alt="Workflow" />
          </div>
          <div>
            <button type="button"
                    class="-mr-3 h-12 w-12 inline-flex items-center justify-center bg-blue-600 rounded-md text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    @click="mobileMenuOpen = true">
              <span class="sr-only">Open sidebar</span>
              <MenuIcon class="h-6 w-6"
                        aria-hidden="true" />
            </button>
          </div>
        </div>
      </div>

      <main class="flex-1 flex overflow-hidden">
        <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
          <nav aria-label="Breadcrumb"
               class="bg-white border-b border-blue-gray-200 xl:hidden">
            <div class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8">
              <a href="#"
                 class="-ml-1 inline-flex items-center space-x-3 text-sm font-medium text-blue-gray-900">
                <ChevronLeftIcon class="h-5 w-5 text-blue-gray-400"
                                 aria-hidden="true" />
                <span>Settings</span>
              </a>
            </div>
          </nav>

          <div class="flex-1 flex xl:overflow-hidden">
            <!-- Secondary sidebar -->
            <nav aria-label="Sections"
                 class="hidden flex-shrink-0 w-64 border-r border-blue-gray-200 xl:flex xl:flex-col"
                 v-if="!route().current('admin.dashboard')">
              <div class="flex-shrink-0 h-16 px-6 border-b border-blue-gray-200 flex items-center">
                <p class="text-lg font-medium text-blue-gray-900">Settings</p>
              </div>
              <div class="flex-1 min-h-0 overflow-y-auto">

                <Link v-for="item in subNavigation"
                      :key="item.name"
                      :href="route(item.router)"
                      :class="[isSubUrl(item.code) ? 'bg-white' : 'hover:bg-blue-50 hover:bg-opacity-50', 'flex justify-between p-4 border-b border-blue-gray-200']"
                      :aria-current="item.current ? 'page' : undefined">
                <p class="text-sm font-normal text-blue-gray-600">{{ item.name }}</p>
                <component :is="item.icon"
                           class="flex-shrink-0 -mt-0.5 h-6 w-6 text-blue-gray-400"
                           aria-hidden="true" />
                </Link>
              </div>
            </nav>

            <!-- Main content -->
            <div class="flex-1 xl:overflow-y-auto bg-white">
              <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
                <slot></slot>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import {
  BellIcon,
  BookmarkAltIcon,
  CashIcon,
  CogIcon,
  FireIcon,
  HomeIcon,
  InboxIcon,
  KeyIcon,
  MenuIcon,
  PhotographIcon,
  SearchCircleIcon,
  UserIcon,
  ViewGridAddIcon,
  XIcon,
  ChevronRightIcon,
  ChartBarIcon,
  ChartSquareBarIcon
} from '@heroicons/vue/outline'
import { ChevronLeftIcon } from '@heroicons/vue/solid'
import { Link } from '@inertiajs/inertia-vue3'
import JetDropdown from '@/Jetstream/Dropdown.vue'
import JetDropdownLink from '@/Jetstream/DropdownLink.vue'

const navigation = [
  { name: '仪表盘', href: '#', icon: HomeIcon, router: 'admin.dashboard', code: 'dashboard', },
  { name: '出售', href: '#', icon: ChartBarIcon, router: 'admin.sales.orders.index', code: 'sales' },
  { name: '目录', href: '#', icon: ChartSquareBarIcon, router: 'admin.catalog.products.index', code: 'catalog' },
  { name: '订单', href: '#', icon: InboxIcon, router: 'admin.dashboard', code: 'xx' },
  { name: '客户', href: '#', icon: UserIcon, router: 'admin.dashboard', code: 'xx' },
  { name: 'CMS', href: '#', icon: UserIcon, router: 'admin.dashboard', code: 'xx' },
  { name: '设置', href: '#', icon: UserIcon, router: 'admin.dashboard', code: 'xx' },
]
const subNavigation = [
  {
    name: '订单',
    description: 'Ullamcorper id at suspendisse nec id volutpat vestibulum enim. Interdum blandit.',
    href: '#',
    icon: ChevronRightIcon,
    router: 'admin.sales.orders.index',
    code: 'orders',
    current: true,
  },
  {
    name: '发票',
    description: 'Ullamcorper id at suspendisse nec id volutpat vestibulum enim. Interdum blandit.',
    href: '#',
    icon: ChevronRightIcon,
    router: 'admin.sales.invoices.index',
    code: 'invoices',
    current: false,
  },
  {
    name: '商品',
    description: 'Ullamcorper id at suspendisse nec id volutpat vestibulum enim. Interdum blandit.',
    href: '#',
    icon: ChevronRightIcon,
    router: 'admin.catalog.products.index',
    code: 'products',
    current: false,
  },
  {
    name: '分类',
    description: 'Ullamcorper id at suspendisse nec id volutpat vestibulum enim. Interdum blandit.',
    href: '#',
    icon: ChevronRightIcon,
    router: 'admin.catalog.categories.index',
    code: 'categories',
    current: false,
  },
  {
    name: '属性',
    description: 'Ullamcorper id at suspendisse nec id volutpat vestibulum enim. Interdum blandit.',
    href: '#',
    icon: ChevronRightIcon,
    router: 'admin.catalog.attributes.index',
    code: 'attributes',
    current: false,
  },
  {
    name: '属性组',
    description: 'Ullamcorper id at suspendisse nec id volutpat vestibulum enim. Interdum blandit.',
    href: '#',
    icon: ChevronRightIcon,
    router: 'admin.catalog.families.index',
    code: 'families',
    current: false,
  },
]
export default {
  components: {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    ChevronLeftIcon,
    MenuIcon,
    XIcon,
    Link,
    JetDropdown,
    JetDropdownLink,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,

  },
  methods: {
    isUrl (...urls) {
      let currentUrl = this.$page.url.substr(1)
      return this.$page.url.split("/")[2] == urls[0]
      return urls[0]
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
    isSubUrl (...urls) {
      let currentUrl = this.$page.url.substr(1)
      return this.$page.url.split("/")[3] == urls[0]
      return urls[0]
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
    logout () {
      this.$inertia.post(route('logout'));
    },
  },
  setup () {
    const mobileMenuOpen = ref(false)

    return {
      navigation,
      subNavigation,
      mobileMenuOpen,
    }
  },
}
</script>