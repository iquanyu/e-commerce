<template>
  <app-layout title="categories">
    <!-- <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template> -->
    <div class="flex justify-between items-center">
      <h1 class="text-3xl font-extrabold text-blue-gray-900">分类</h1>
      <div class="flex items-center">
        <Link :href="route('admin.catalog.categories.create')"
              as="button"
              type="button"
              class="block bg-blue-600 text-white px-3 py-2 text-sm rounded ml-4">
        新增分类
        </Link>
      </div>
    </div>
    <hr class="my-4" />
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="mt-6">
      <div class="flex justify-between items-center">
        <div>
          <label for="search"
                 class="sr-only text-sm font-medium text-gray-700">Search</label>
          <div class="mt-1 relative rounded-md shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <span class="text-gray-500 sm:text-sm">
                <SearchIcon class="w-4 h-4" />
              </span>
            </div>
            <input type="text"
                   name="search"
                   id="search"
                   v-model="form.search"
                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-8 pr-12 sm:text-sm border-gray-300 rounded-md"
                   placeholder="search……" />
            <div class="absolute inset-y-0 right-0 flex items-center">
              <label for="status"
                     class="sr-only">Status</label>
              <select id="status"
                      name="status"
                      v-model="form.status"
                      class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                <option value="">All</option>
                <option value="0">隐藏</option>
                <option value="1">显示</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="flex flex-col mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      ID
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      名称
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Position
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      状态
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      产品数
                    </th>
                    <th scope="col"
                        class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="category in categories.data"
                      :key="category.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ category.id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{ category.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{ category.position }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">
                        {{ category.status ? '显示' : '隐藏' }}
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">0</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center">
                      <Link :href="route('admin.catalog.categories.edit', category.id)"
                            class="text-indigo-600 hover:text-indigo-900">
                      <PencilAltIcon class="w-5 h-5" />
                      </Link>
                      <a href="#"
                         class="text-indigo-600 hover:text-indigo-900">
                        <TrashIcon class="w-5 h-5" />
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <pagination class="mt-6"
                  :links="categories.links"
                  :data="categories" />
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'


import { SearchIcon, EyeIcon, LogoutIcon, TrashIcon, PencilAltIcon } from "@heroicons/vue/outline"

import { ArrowSmDownIcon, ArrowSmUpIcon, ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
import { Link } from '@inertiajs/inertia-vue3'
import Pagination from '@/Shared/Pagination'

export default defineComponent({
  props: {
    categories: Object,
    filters: Object
  },
  components: {
    AppLayout,
    ArrowSmDownIcon,
    ArrowSmUpIcon,
    ChevronRightIcon,
    ChevronLeftIcon,
    SearchIcon,
    EyeIcon,
    LogoutIcon,
    TrashIcon,
    PencilAltIcon,
    Link,
    Pagination
  },
  data () {
    return {
      form: {
        search: this.filters.search,
        status: this.filters.status,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/admin/catalog/categories', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  setup () {
    return {
    }
  },
})
</script>


