<template>
  <div v-if="links.length > 3">

    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-0">
      <div class="flex-1 flex justify-between sm:hidden">
        <!-- <a href="#"
           class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">

        </a> -->
        <Link :disabled="!data.prev_page_url"
              :href="data.prev_page_url"
              class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
        Previous
        </Link>
        <Link :disabled="!data.next_page_url"
              :href="data.next_page_url"
              class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
        Next
        </Link>
        <!-- <a href="#"
           class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">

        </a> -->
      </div>
      <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
          <p class="text-sm text-gray-700">
            显示从
            {{ ' ' }}
            <span class="font-medium">{{ data.from }}</span>
            {{ ' ' }}
            到
            {{ ' ' }}
            <span class="font-medium">{{ data.to }}</span>
            {{ ' ' }}
            总共
            {{ ' ' }}
            <span class="font-medium">{{ data.total }}</span>
            {{ ' ' }}
            条数据
          </p>
        </div>
        <div>
          <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
               aria-label="Pagination">

            <template v-for="(link, key) in data.links">
              <div v-if="link.url === null"
                   :key="key"
                   class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                   v-html="link.label" />
              <Link v-else
                    :key="`link-${key}`"
                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                    :class="link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'"
                    :href="link.url"
                    v-html="link.label" />
            </template>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    Link,
  },
  props: {
    links: Array,
    data: Object,
  },
}
</script>
