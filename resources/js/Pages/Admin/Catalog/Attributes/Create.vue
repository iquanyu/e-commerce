<template>
  <app-layout title="Dashboard">
    <!-- <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template> -->
    <div class="flex justify-between items-center">
      <h1 class="text-3xl font-extrabold text-blue-gray-900 flex items-center">
        <ChevronLeftIcon class="w-6 h-6 mr-2" />
        新增属性
      </h1>
    </div>
    <hr class="my-4" />
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="mt-6">
      <form @submit.prevent="store">
        <Disclosure v-slot="{ open }">
          <DisclosureButton class="flex justify-between w-full px-4 py-4 text-sm font-medium text-left bg-gray-50 border-b focus:outline-none focus-visible:ring focus-visible:ring-opacity-75">
            <span>基础</span>

            <!-- Use the `open` slot prop to rotate the icon when the panel is open -->
            <ChevronRightIcon :class='open ? "transform rotate-90" : ""'
                              class="w-5 h-5 text-blue-500" />
          </DisclosureButton>
          <DisclosurePanel static>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="attribute-code"
                         class="block text-sm font-medium text-gray-700">
                    属性代码
                    <span class="text-red-600">*</span>
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input type="text"
                           name="attribute-code"
                           id="attribute-code"
                           v-model="form.code"
                           :error="form.errors.code"
                           class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" />
                  </div>
                  <p class="mt-2 text-sm text-red-500"
                     v-if="form.errors.code">
                    {{ form.errors.code }}
                  </p>
                </div>
              </div>

              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="attribute-name"
                         class="block text-sm font-medium text-gray-700">
                    属性名称
                    <span class="text-red-600">*</span>
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input type="text"
                           name="attribute-name"
                           id="attribute-name"
                           v-model="form.name"
                           :error="form.errors.name"
                           class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" />
                  </div>
                  <p class="mt-2 text-sm text-red-500"
                     v-if="form.errors.name">
                    {{ form.errors.name }}
                  </p>
                </div>
              </div>

              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="attribute-type"
                         class="block text-sm font-medium text-gray-700">
                    属性类型
                    <span class="text-red-600">*</span>
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select name="attribute-type"
                            id="attribute-type"
                            autocomplete="country-name"
                            v-model="form.type"
                            :error="form.errors.type"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      <option value="text">Text</option>
                      <option value="textarea">Textarea</option>
                      <option value="price">Price</option>
                      <option value="boolean">Boolean</option>
                      <option value="select">Select</option>
                      <option value="multiselect">Multiselect</option>
                      <option value="datetime">Datetime</option>
                      <option value="date">Date</option>
                      <option value="image">Image</option>
                      <option value="file">File</option>
                      <option value="checkbox">Checkbox</option>
                    </select>
                  </div>
                  <p class="mt-2 text-sm text-red-500"
                     v-if="form.errors.type">
                    {{ form.errors.type }}
                  </p>
                </div>
              </div>
            </div>
          </DisclosurePanel>
        </Disclosure>

        <Disclosure v-slot="{ open }">
          <DisclosureButton class="flex justify-between w-full px-4 py-4 text-sm font-medium text-left bg-gray-50 border-b focus:outline-none focus-visible:ring focus-visible:ring-opacity-75">
            <span>配置</span>

            <!-- Use the `open` slot prop to rotate the icon when the panel is open -->
            <ChevronRightIcon :class='open ? "transform rotate-90" : ""'
                              class="w-5 h-5 text-blue-500" />
          </DisclosureButton>
          <DisclosurePanel>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="attribute-configurable"
                         class="block text-sm font-medium text-gray-700">
                    用于创建可配置的产品
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select name="attribute-configurable"
                            id="attribute-configurable"
                            autocomplete="attribute-configurable"
                            v-model="form.is_configurable"
                            :error="form.errors.is_configurable"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      <option value="0">No</option>
                      <option value="1">Yes</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="attribute-is-visible-on-front"
                         class="block text-sm font-medium text-gray-700">
                    在前端的产品视图页面上可见
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select name="attribute-is-visible-on-front"
                            id="attribute-is-visible-on-front"
                            autocomplete="attribute-is-visible-on-front"
                            v-model="form.is_visible_on_front"
                            :error="form.errors.is_visible_on_front"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      <option value="0">No</option>
                      <option value="1">Yes</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="attribute-is-comparable"
                         class="block text-sm font-medium text-gray-700">
                    属性具有可比性
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select name="attribute-is-comparable"
                            id="attribute-is-comparable"
                            autocomplete="attribute-is-comparable"
                            v-model="form.is_comparable"
                            :error="form.errors.is_comparable"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      <option value="0">No</option>
                      <option value="1">Yes</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- <div class="grid grid-cols-4 gap-6">
              <div class="col-span-2 sm:col-span-2">
                <label for="attribute-configurable"
                       class="block text-sm font-medium text-gray-700">
                  在产品平面表中创建
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <select name="attribute-configurable"
                          id="attribute-configurable"
                          autocomplete="attribute-configurable"
                          class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>
              </div>
            </div> -->

            </div>
          </DisclosurePanel>

        </Disclosure>

        <Disclosure v-slot="{ open }"
                    v-if="form.type == 'select'">
          <DisclosureButton class="flex justify-between w-full px-4 py-4 text-sm font-medium text-left bg-gray-50 border-b focus:outline-none focus-visible:ring focus-visible:ring-opacity-75">
            <span>选项</span>

            <!-- Use the `open` slot prop to rotate the icon when the panel is open -->
            <ChevronRightIcon :class='open ? "transform rotate-90" : ""'
                              class="w-5 h-5 text-blue-500" />
          </DisclosureButton>
          <DisclosurePanel>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="swatch_type"
                         class="block text-sm font-medium text-gray-700">
                    选项类型
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select name="swatch_type"
                            id="swatch_type"
                            autocomplete="swatch_type"
                            v-model="form.swatch_type"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      <option value="select">下拉</option>
                      <option value="color"
                              disabled>颜色</option>
                      <option value="img"
                              disabled>图像</option>
                      <option value="text"
                              disabled>文本</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input id="default_null_option"
                         name="default_null_option"
                         type="checkbox"
                         v-model="form.default_null_option"
                         class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded" />
                </div>
                <div class="ml-3 text-sm">
                  <label for="default_null_option"
                         class="font-medium text-gray-700">创建默认空选项</label>
                  <p class="text-gray-500 sr-only">Get notified when someones posts a comment on a posting.</p>
                </div>
              </div>

              <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden sm:rounded-lg">
                      <table class="min-w-full divide-y divide-gray-200 table-fixed">
                        <thead class="bg-gray-50">
                          <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              名称
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              排序
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                          <tr v-for="(item, index) in form.options"
                              :key="index">
                            <td class="px-6 py-4 whitespace-nowrap">
                              <input type="text"
                                     name="attribute-code"
                                     id="attribute-code"
                                     v-model="item.name"
                                     class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" />

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <input type="text"
                                     name="attribute-code"
                                     id="attribute-code"
                                     v-model="item.order"
                                     class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" />

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <TrashIcon class="w-5 h-5 text-gray-500 cursor-pointer"
                                         @click="removeListItem(index)" />
                            </td>
                          </tr>

                          <!-- More people... -->
                        </tbody>
                      </table>

                    </div>

                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md mx-6 text-sm"
                            type="button"
                            @click="addListItem">新增选项</button>
                  </div>
                </div>
              </div>
            </div>
          </DisclosurePanel>
        </Disclosure>

        <Disclosure v-slot="{ open }">
          <DisclosureButton class="flex justify-between w-full px-4 py-4 text-sm font-medium text-left bg-gray-50 border-b focus:outline-none focus-visible:ring focus-visible:ring-opacity-75">
            <span>验证</span>

            <!-- Use the `open` slot prop to rotate the icon when the panel is open -->
            <ChevronRightIcon :class='open ? "transform rotate-90" : ""'
                              class="w-5 h-5 text-blue-500" />
          </DisclosureButton>
          <DisclosurePanel>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="is-required"
                         class="block text-sm font-medium text-gray-700">
                    必填
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select name="is-required"
                            id="is-required"
                            autocomplete="is-required"
                            v-model="form.is_required"
                            :error="form.errors.is_required"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      <option value="0">No</option>
                      <option value="1">Yes</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="is-unique"
                         class="block text-sm font-medium text-gray-700">
                    唯一
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select name="is-unique"
                            id="is-unique"
                            autocomplete="is-unique"
                            v-model="form.is_unique"
                            :error="form.errors.is_unique"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      <option value="0">No</option>
                      <option value="1">Yes</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="attribute-type"
                         class="block text-sm font-medium text-gray-700">
                    输入验证
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select name="attribute-type"
                            id="attribute-type"
                            autocomplete="country-name"
                            v-model="form.validation"
                            :error="form.errors.validation"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      <option value=""></option>
                      <option value="number">Number</option>
                      <option value="email">Email</option>
                      <option value="decimal">Decimal</option>
                      <option value="url">Url</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </DisclosurePanel>
        </Disclosure>

        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
          <button type="submit"
                  class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            保存
          </button>
        </div>
      </form>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
} from '@headlessui/vue'

import { SearchIcon, EyeIcon, LogoutIcon } from "@heroicons/vue/outline"

import { ArrowSmDownIcon, ArrowSmUpIcon, ChevronLeftIcon, ChevronRightIcon, TrashIcon } from '@heroicons/vue/solid'

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
  data () {
    return {
      form: this.$inertia.form({
        code: null,
        name: null,
        type: 'select',
        is_required: 0,
        is_configurable: 0,
        is_unique: 0,
        is_visible_on_front: 0,
        is_comparable: 0,
        swatch_type: 'select',
        default_null_option: false,
        options: [
          {
            'name': '',
            'order': ''
          }
        ]
      }),
    }
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
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    TrashIcon,
  },
  methods: {
    store () {
      this.form.post('/admin/catalog/attributes')
    },
    addListItem () {
      this.form.options.push({
        'name': '',
        'position': ''
      })
    },
    removeListItem (index) {
      console.log(index)
      if (this.form.options.length > 1) {
        this.form.options.splice(index, 1)
      }

    }
  },
  setup () {
    return {
      stats,
      orders
    }
  },
})
</script>