<template>
  <app-layout title="Dashboard">
    <!-- <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template> -->
    <h1 class="text-3xl font-extrabold text-blue-gray-900">Orders</h1>
    <hr class="my-4" />
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="mt-6">
      <div class="flex justify-between items-center">
        <div>
          <label for="price"
                 class="sr-only text-sm font-medium text-gray-700">Price</label>
          <div class="mt-1 relative rounded-md shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <span class="text-gray-500 sm:text-sm">
                <SearchIcon class="w-4 h-4" />
              </span>
            </div>
            <input type="text"
                   name="price"
                   id="price"
                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-8 pr-12 sm:text-sm border-gray-300 rounded-md"
                   placeholder="search……" />
            <div class="absolute inset-y-0 right-0 flex items-center">
              <label for="state"
                     class="sr-only">state</label>
              <select id="state"
                      name="state"
                      class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                <option>All</option>
                <option>Processing</option>
                <option>Pending</option>
                <option>Completed</option>
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
                      小记
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      总计
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      状态
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      付款方式
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      下单时间
                    </th>
                    <th scope="col"
                        class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="order in orders"
                      :key="order.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ order.id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{ order.sub_total }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ order.grand_total }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        {{ order.status }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ order.payment_method }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ order.ordered_at }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <a href="#"
                         class="text-indigo-600 hover:text-indigo-900">
                        <EyeIcon class="w-5 h-5" />
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-0">
        <div class="flex-1 flex justify-between sm:hidden">
          <a href="#"
             class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Previous
          </a>
          <a href="#"
             class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Next
          </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-700">
              Showing
              {{ ' ' }}
              <span class="font-medium">1</span>
              {{ ' ' }}
              to
              {{ ' ' }}
              <span class="font-medium">10</span>
              {{ ' ' }}
              of
              {{ ' ' }}
              <span class="font-medium">97</span>
              {{ ' ' }}
              results
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                 aria-label="Pagination">
              <a href="#"
                 class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <ChevronLeftIcon class="h-5 w-5"
                                 aria-hidden="true" />
              </a>
              <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
              <a href="#"
                 aria-current="page"
                 class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                1
              </a>
              <a href="#"
                 class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                2
              </a>
              <a href="#"
                 class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium">
                3
              </a>
              <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                ...
              </span>
              <a href="#"
                 class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium">
                8
              </a>
              <a href="#"
                 class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                9
              </a>
              <a href="#"
                 class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                10
              </a>
              <a href="#"
                 class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Next</span>
                <ChevronRightIcon class="h-5 w-5"
                                  aria-hidden="true" />
              </a>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Welcome from '@/Jetstream/Welcome.vue'


import { SearchIcon, EyeIcon } from "@heroicons/vue/outline"

import { ArrowSmDownIcon, ArrowSmUpIcon, ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'

const stats = [
  { name: '客户', stat: '71', change: '12%', changeType: 'increase' },
  { name: '订单', stat: '5816', change: '2.02%', changeType: 'increase' },
  { name: '总销售额', stat: '¥ 9870.00', change: '4.05%', changeType: 'increase' },
  { name: '平均订单销售', stat: '¥ 240.57', change: '4.05%', changeType: 'decrease' },
]
const orders = [
  {
    id: 1,
    sub_total: '¥ 300.00',
    grand_total: '¥ 600.00',
    ordered_at: "2021-03-18 05:01:09",
    status: '已完成',
    payment_method: "支付宝",
  },
  {
    id: 2,
    sub_total: '¥ 300.00',
    grand_total: '¥ 600.00',
    ordered_at: "2021-03-18 05:01:09",
    status: '已完成',
    payment_method: "支付宝",
  },
  {
    id: 3,
    sub_total: '¥ 300.00',
    grand_total: '¥ 600.00',
    ordered_at: "2021-03-18 05:01:09",
    status: '已完成',
    payment_method: "支付宝",
  },
  {
    id: 4,
    sub_total: '¥ 300.00',
    grand_total: '¥ 600.00',
    ordered_at: "2021-03-18 05:01:09",
    status: '已完成',
    payment_method: "支付宝",
  },
  {
    id: 5,
    sub_total: '¥ 300.00',
    grand_total: '¥ 600.00',
    ordered_at: "2021-03-18 05:01:09",
    status: '已完成',
    payment_method: "支付宝",
  },

  // More people...
]

export default defineComponent({
  components: {
    AppLayout,
    Welcome,
    ArrowSmDownIcon,
    ArrowSmUpIcon,
    ChevronRightIcon,
    ChevronLeftIcon,
    SearchIcon,
    EyeIcon
  },
  setup () {
    return {
      stats,
      orders
    }
  },
})
</script>


