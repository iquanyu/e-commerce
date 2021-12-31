<template>
  <app-layout title="编辑属性组">
    <!-- <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template> -->
    <div class="flex justify-between items-center">
      <h1 class="text-3xl font-extrabold text-blue-gray-900 flex items-center">
        <ChevronLeftIcon class="w-6 h-6 mr-2" />
        编辑属性组
      </h1>
    </div>
    <hr class="my-4" />
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="mt-6">
      <form @submit.prevent="update">
        <Disclosure v-slot="{ open = true }"
                    :defaultOpen="disclosureDefaultOpen">
          <DisclosureButton class="flex justify-between w-full px-4 py-4 text-sm font-medium text-left bg-gray-50 border-b focus:outline-none focus-visible:ring focus-visible:ring-opacity-75">
            <span>基础</span>

            <!-- Use the `open` slot prop to rotate the icon when the panel is open -->
            <ChevronRightIcon :class='open ? "transform rotate-90" : ""'
                              class="w-5 h-5 text-blue-500" />
          </DisclosureButton>
          <DisclosurePanel>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="attribute-code"
                         class="block text-sm font-medium text-gray-700">
                    属性组代码
                    <span class="text-red-600">*</span>
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input type="text"
                           name="attribute-code"
                           id="attribute-code"
                           v-model="form.code"
                           :error="form.errors.code"
                           disabled
                           class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300 bg-gray-200" />
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
                    属性组名称
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
            </div>
          </DisclosurePanel>
        </Disclosure>

        <Disclosure v-slot="{ open }"
                    :defaultOpen="disclosureDefaultOpen">
          <DisclosureButton class="flex justify-between w-full px-4 py-4 text-sm font-medium text-left bg-gray-50 border-b focus:outline-none focus-visible:ring focus-visible:ring-opacity-75">
            <span>分组</span>

            <!-- Use the `open` slot prop to rotate the icon when the panel is open -->
            <ChevronRightIcon :class='open ? "transform rotate-90" : ""'
                              class="w-5 h-5 text-blue-500" />
          </DisclosureButton>

          <DisclosurePanel>

            <div class="px-4 py-4">

              <button class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-md mb-6 text-sm"
                      type="button"
                      @click="addGroupItemForm = true">新增分组</button>

              <Disclosure v-for="(group,i) in form.groups"
                          :key="i"
                          v-slot="{ open }"
                          :defaultOpen="disclosureDefaultOpen">
                <DisclosureButton class="flex justify-between w-full px-4 py-4 text-sm font-medium text-left bg-gray-50 border-b focus:outline-none focus-visible:ring focus-visible:ring-opacity-75">
                  <span>{{ group.name }}{{ group.position }}</span>

                  <!-- Use the `open` slot prop to rotate the icon when the panel is open -->
                  <ChevronRightIcon :class='open ? "transform rotate-90" : ""'
                                    class="w-5 h-5 text-blue-500" />
                </DisclosureButton>
                <DisclosurePanel>
                  <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="flex flex-col">
                      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                          <div class="overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                              <thead class="bg-gray-50">
                                <tr>
                                  <th scope="col"
                                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Code
                                  </th>
                                  <th scope="col"
                                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    名称
                                  </th>
                                  <th scope="col"
                                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    类型
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
                                <template v-for="(item, index) in group.custom_attributes"
                                          :key="index">
                                  <tr v-if="item.created_at">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                      {{ item.code }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                      {{ item.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                      {{ item.type }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                      <TrashIcon class="w-5 h-5 text-gray-500 cursor-pointer"
                                                 @click="removeGroupItem(i,index)"
                                                 v-if="item.is_user_defined" />
                                    </td>
                                  </tr>
                                </template>
                                <!-- More people... -->
                              </tbody>
                            </table>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </DisclosurePanel>
              </Disclosure>
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

    <!-- Add Group Item Modal -->
    <jet-dialog-modal :show="addGroupItemForm"
                      @close="closeModal">
      <template #title>
        新增分组
      </template>

      <template #content>
        <div class="mt-4">
          <div class="col-span-6 sm:col-span-4">
            <label for="group-name"
                   class="block text-sm font-medium text-gray-700">分组名称</label>
            <jet-input type="text"
                       name="group-name"
                       id="group-name"
                       v-model="group_item_form.name"
                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-3/4 shadow-sm sm:text-sm border-gray-300 rounded-md" />

            <jet-input-error :message="group_item_form.errors.name"
                             class="mt-2" />
          </div>

          <div class="col-span-6 sm:col-span-4 mt-4">
            <label for="group-position"
                   class="block text-sm font-medium text-gray-700">分组排序</label>
            <jet-input type="text"
                       name="group-position"
                       id="group-position"
                       v-model="group_item_form.position"
                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-3/4 shadow-sm sm:text-sm border-gray-300 rounded-md" />

            <jet-input-error :message="group_item_form.errors.name"
                             class="mt-2" />
          </div>

        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="closeModal">
          取消
        </jet-secondary-button>

        <jet-danger-button class="ml-2"
                           @click="addGroupItem"
                           :class="{ 'opacity-25': group_item_form.processing }"
                           :disabled="group_item_form.processing">
          保存
        </jet-danger-button>
      </template>
    </jet-dialog-modal>
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
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetDangerButton from '@/Jetstream/DangerButton.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

export default defineComponent({
  props: {
    family: Object
  },
  data () {
    return {
      disclosureDefaultOpen: true,
      //open: true,
      addGroupItemForm: false,
      group_item_form: this.$inertia.form({
        name: '',
        position: ''
      }),
      form: this.$inertia.form({
        code: this.family.code,
        name: this.family.name,
        type: this.family.type,
        is_user_defined: this.family.is_user_defined,
        groups: this.family.attribute_groups,
        status: this.family.status,
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
    JetDialogModal, JetInput, JetInputError, JetSecondaryButton, JetDangerButton
  },
  methods: {
    update () {
      this.form.put(`/admin/catalog/families/${this.family.id}`)
    },
    addGroupItem () {
      this.form.groups.push({
        is_user_defined: 1,
        name: this.group_item_form.name,
        position: this.group_item_form.position,
        custom_attributes: []
      })
      this.closeModal()
    },
    removeGroupItem (i, index) {
      console.log(i)
      console.log(index)

      //this.form.groups[i].custom_attributes.splice(index, 1)

      this.form.groups[i].custom_attributes[index].is_del = true
      this.form.groups[i].custom_attributes[index].created_at = null

      console.log(this.form.groups[i].custom_attributes[index].is_del)
    },
    closeModal () {
      this.addGroupItemForm = false

      this.group_item_form.reset()
    },
  },
  setup () {
    return {
    }
  },
})
</script>