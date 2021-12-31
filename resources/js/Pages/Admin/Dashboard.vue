<template>
  <app-layout title="Dashboard">
    <!-- <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template> -->
    <h1 class="text-3xl font-extrabold text-blue-gray-900">Dashboard</h1>
    <hr class="my-4" />
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="mt-6">
      <!-- <h3 class="text-lg leading-6 font-medium text-gray-900">
        Last 30 days
      </h3> -->
      <dl class="mt-5 grid grid-cols-1 bg-white gap-4 divide-y divide-gray-200 md:grid-cols-3">
        <div v-for="item in stats"
             :key="item.name"
             class="px-4 py-5 sm:p-6 shadow-md rounded-md border">
          <dt class="text-base font-normal text-gray-900">
            {{ item.name }}
          </dt>
          <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
            <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
              {{ item.stat }}
              <!-- <span class="ml-2 text-sm font-medium text-gray-500"> from {{ item.previousStat }} </span> -->
            </div>

            <div :class="[item.changeType === 'increase' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800', 'inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium md:mt-2 lg:mt-0']">
              <ArrowSmUpIcon v-if="item.changeType === 'increase'"
                             class="-ml-1 mr-0.5 flex-shrink-0 self-center h-5 w-5 text-green-500"
                             aria-hidden="true" />
              <ArrowSmDownIcon v-else
                               class="-ml-1 mr-0.5 flex-shrink-0 self-center h-5 w-5 text-red-500"
                               aria-hidden="true" />
              <span class="sr-only"> {{ item.changeType === 'increase' ? 'Increased' : 'Decreased' }} by </span>
              {{ item.change }}
            </div>
          </dd>
        </div>
      </dl>
    </div>

    <div class="mt-6">
      <div class="grid grid-cols-2 gap-4">
        <div class="p-4 rounded shadow-md border">
          <h2>库存预警</h2>
          <ul role="list"
              class="divide-y divide-gray-200">
            <li class="px-4 py-4 sm:px-0 flex items-center justify-between">
              <div class="flex items-center">
                <img src="/images/be8ecd190a639396.jpg"
                     class="w-16 h-16"
                     alt="">
                <div>
                  <p class="text-base font-medium text-blue-gray-900">Apple iPhone 13 (A2634) </p>
                  <p class="mt-1 text-sm text-blue-gray-500">1000</p>
                </div>
              </div>
              <ChevronRightIcon :class="['h-5 w-5 text-gray-400']" />
            </li>
            <li class="px-4 py-4 sm:px-0 flex items-center justify-between">
              <div class="flex items-center">
                <img src="/images/be8ecd190a639396.jpg"
                     class="w-16 h-16"
                     alt="">
                <div>
                  <p class="text-base font-medium text-blue-gray-900">Apple iPhone 13 (A2634) </p>
                  <p class="mt-1 text-sm text-blue-gray-500">1000</p>
                </div>
              </div>
              <ChevronRightIcon :class="['h-5 w-5 text-gray-400']" />
            </li>
            <li class="px-4 py-4 sm:px-0 flex items-center justify-between">
              <div class="flex items-center">
                <img src="/images/be8ecd190a639396.jpg"
                     class="w-16 h-16"
                     alt="">
                <div>
                  <p class="text-base font-medium text-blue-gray-900">Apple iPhone 13 (A2634) </p>
                  <p class="mt-1 text-sm text-blue-gray-500">1000</p>
                </div>
              </div>
              <ChevronRightIcon :class="['h-5 w-5 text-gray-400']" />
            </li>
            <li class="px-4 py-4 sm:px-0 flex items-center justify-between">
              <div class="flex items-center">
                <img src="/images/be8ecd190a639396.jpg"
                     class="w-16 h-16"
                     alt="">
                <div>
                  <p class="text-base font-medium text-blue-gray-900">Apple iPhone 13 (A2634) </p>
                  <p class="mt-1 text-sm text-blue-gray-500">1000</p>
                </div>
              </div>
              <ChevronRightIcon :class="['h-5 w-5 text-gray-400']" />
            </li>
          </ul>
        </div>
        <div class="p-4 rounded shadow-md border">

        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Welcome from '@/Jetstream/Welcome.vue'


import { ChevronRightIcon } from "@heroicons/vue/outline"

import { ArrowSmDownIcon, ArrowSmUpIcon } from '@heroicons/vue/solid'

const stats = [
  { name: '客户', stat: '71', change: '12%', changeType: 'increase' },
  { name: '订单', stat: '5816', change: '2.02%', changeType: 'increase' },
  { name: '总销售额', stat: '¥ 9870.00', change: '4.05%', changeType: 'increase' },
  { name: '平均订单销售', stat: '¥ 240.57', change: '4.05%', changeType: 'decrease' },
]

export default defineComponent({
  components: {
    AppLayout,
    Welcome,
    ArrowSmDownIcon,
    ArrowSmUpIcon,
    ChevronRightIcon
  },
  setup () {
    return {
      stats,
    }
  },
})
</script>


