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
        编辑分类
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
          <DisclosurePanel static>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="category-name"
                         class="block text-sm font-medium text-gray-700">
                    分类名称
                    <span class="text-red-600">*</span>
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input type="text"
                           name="category-name"
                           id="category-name"
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
                  <label for="category-status"
                         class="block text-sm font-medium text-gray-700">
                    在菜单中可见
                    <span class="text-red-600">*</span>
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select name="category-status"
                            id="category-status"
                            v-model="form.status"
                            :error="form.errors.status"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      <option value="0">隐藏</option>
                      <option value="1">显示</option>
                    </select>
                  </div>
                  <p class="mt-2 text-sm text-red-500"
                     v-if="form.errors.status">
                    {{ form.errors.status }}
                  </p>
                </div>
              </div>

              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="category-position"
                         class="block text-sm font-medium text-gray-700">
                    分类排序
                    <span class="text-red-600">*</span>
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input type="text"
                           name="category-position"
                           id="category-position"
                           v-model="form.position"
                           :error="form.errors.position"
                           class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" />
                  </div>
                  <p class="mt-2 text-sm text-red-500"
                     v-if="form.errors.position">
                    {{ form.errors.position }}
                  </p>
                </div>
              </div>
            </div>
          </DisclosurePanel>
        </Disclosure>

        <Disclosure v-slot="{ open = true }"
                    :defaultOpen="disclosureDefaultOpen">
          <DisclosureButton class="flex justify-between w-full px-4 py-4 text-sm font-medium text-left bg-gray-50 border-b focus:outline-none focus-visible:ring focus-visible:ring-opacity-75">
            <span>描述和图像</span>

            <!-- Use the `open` slot prop to rotate the icon when the panel is open -->
            <ChevronRightIcon :class='open ? "transform rotate-90" : ""'
                              class="w-5 h-5 text-blue-500" />
          </DisclosureButton>
          <DisclosurePanel>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="category-configurable"
                         class="block text-sm font-medium text-gray-700">
                    显示模式
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select name="category-configurable"
                            id="category-configurable"
                            autocomplete="category-configurable"
                            v-model="form.display_mode"
                            :error="form.errors.display_mode"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      <option value="products_and_description">产品和描述</option>
                      <option value="products_only">只产品</option>
                      <option value="description_only">只描述</option>
                    </select>
                  </div>
                </div>
              </div>

              <div>
                <label for="description"
                       class="block text-sm font-medium text-gray-700">
                  描述
                  <span class="text-red-600">*</span>
                </label>

                <textarea id="description"
                          name="description"
                          rows="3"
                          v-model="form.description"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                          placeholder="……"></textarea>

                <p class="mt-2 text-sm text-gray-500">
                  Brief description for your profile. URLs are hyperlinked.
                </p>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">
                  图像
                </label>
                <div class="mt-1 flex items-center">
                  <input type="file"
                         ref="image"
                         class="hidden"
                         @change="updateImagePreview">
                  <span class="inline-block h-24 w-24 rounded overflow-hidden bg-gray-100"
                        v-show="! imagePreview && !category.image_url">
                    <PhotographIcon class="h-full w-full text-gray-300" />
                  </span>

                  <span class="inline-block h-24 w-24 rounded overflow-hidden bg-gray-100 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + category.image_url + '\');'"
                        v-show="! imagePreview && category.image_url">
                  </span>

                  <span class="inline-block h-24 w-24 rounded overflow-hidden bg-gray-100 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + imagePreview + '\');'"
                        v-show="imagePreview">
                  </span>
                  <button type="button"
                          @click.prevent="selectNewImage"
                          class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                    选择一张新图片
                  </button>
                  <button type="button"
                          v-show="imagePreview"
                          @click.prevent="deleteImage"
                          class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                    重置图片
                  </button>
                </div>
              </div>

              <!-- <div>
                <label class="block text-sm font-medium text-gray-700">
                  Logo
                </label>
                <div class="mt-1 flex items-center">
                  <span class="inline-block h-24 w-24 rounded overflow-hidden bg-gray-100">
                    <PhotographIcon class="h-full w-full text-gray-300" />
                  </span>
                  <button type="button"
                          class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Change
                  </button>
                </div>
              </div> -->

            </div>
          </DisclosurePanel>

        </Disclosure>

        <Disclosure v-slot="{ open = true }"
                    :defaultOpen="disclosureDefaultOpen">
          <DisclosureButton class="flex justify-between w-full px-4 py-4 text-sm font-medium text-left bg-gray-50 border-b focus:outline-none focus-visible:ring focus-visible:ring-opacity-75">
            <span>父类别</span>

            <!-- Use the `open` slot prop to rotate the icon when the panel is open -->
            <ChevronRightIcon :class='open ? "transform rotate-90" : ""'
                              class="w-5 h-5 text-blue-500" />
          </DisclosureButton>
          <DisclosurePanel>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="parent_id"
                         class="block text-sm font-medium text-gray-700">
                    父级分类
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select name="parent_id"
                            id="parent_id"
                            v-model="form.parent_id"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      <option value="null">无</option>
                      <option :value="item.id"
                              v-for="item in tree"
                              :key="item.id">{{ item.name }}</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </DisclosurePanel>
        </Disclosure>

        <!-- <Disclosure v-slot="{ open = true }"
                    :defaultOpen="disclosureDefaultOpen">
          <DisclosureButton class="flex justify-between w-full px-4 py-4 text-sm font-medium text-left bg-gray-50 border-b focus:outline-none focus-visible:ring focus-visible:ring-opacity-75">
            <span>可过滤属性</span>

        <ChevronRightIcon :class='open ? "transform rotate-90" : ""'
                          class="w-5 h-5 text-blue-500" />
        </DisclosureButton>
        <DisclosurePanel>
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

            <div class="grid grid-cols-4 gap-6">
              <div class="col-span-2 sm:col-span-2">
                <label for="attributes"
                       class="block text-sm font-medium text-gray-700">
                  属性
                  <span class="text-red-600">*</span>
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <select name="attributes"
                          id="attributes"
                          multiple
                          autocomplete="attributes"
                          v-model="form.is_required"
                          :error="form.errors.is_required"
                          class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option v-for="attribute in attributes"
                            :key="attribute.id"
                            :value="attribute.id">{{ attribute.name }}</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </DisclosurePanel>
        </Disclosure> -->

        <Disclosure v-slot="{ open = true }"
                    :defaultOpen="disclosureDefaultOpen">
          <DisclosureButton class="flex justify-between w-full px-4 py-4 text-sm font-medium text-left bg-gray-50 border-b focus:outline-none focus-visible:ring focus-visible:ring-opacity-75">
            <span>搜索引擎优化</span>

            <ChevronRightIcon :class='open ? "transform rotate-90" : ""'
                              class="w-5 h-5 text-blue-500" />
          </DisclosureButton>
          <DisclosurePanel>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="meta_title"
                         class="block text-sm font-medium text-gray-700">
                    Meta 标题
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input type="text"
                           name="meta_title"
                           id="meta_title"
                           v-model="form.meta_title"
                           :error="form.errors.meta_title"
                           class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" />
                  </div>
                  <p class="mt-2 text-sm text-red-500"
                     v-if="form.errors.meta_title">
                    {{ form.errors.meta_title }}
                  </p>
                </div>
              </div>
              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="slug"
                         class="block text-sm font-medium text-gray-700">
                    Slug
                    <span class="text-red-600">*</span>
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input type="text"
                           name="slug"
                           id="slug"
                           v-model="form.slug"
                           :error="form.errors.slug"
                           class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" />
                  </div>
                  <p class="mt-2 text-sm text-red-500"
                     v-if="form.errors.slug">
                    {{ form.errors.slug }}
                  </p>
                </div>
              </div>

              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="meta_description"
                         class="block text-sm font-medium text-gray-700">
                    Meta 描述
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input type="text"
                           name="meta_description"
                           id="meta_description"
                           v-model="form.meta_description"
                           :error="form.errors.meta_description"
                           class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" />
                  </div>
                  <p class="mt-2 text-sm text-red-500"
                     v-if="form.errors.meta_description">
                    {{ form.errors.meta_description }}
                  </p>
                </div>
              </div>

              <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2 sm:col-span-2">
                  <label for="meta_keywords"
                         class="block text-sm font-medium text-gray-700">
                    Meta 关键词
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input type="text"
                           name="meta_keywords"
                           id="meta_keywords"
                           v-model="form.meta_keywords"
                           :error="form.errors.meta_keywords"
                           class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" />
                  </div>
                  <p class="mt-2 text-sm text-red-500"
                     v-if="form.errors.meta_keywords">
                    {{ form.errors.meta_keywords }}
                  </p>
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
import { SearchIcon, EyeIcon, LogoutIcon, PhotographIcon } from "@heroicons/vue/outline"
import { ArrowSmDownIcon, ArrowSmUpIcon, ChevronLeftIcon, ChevronRightIcon, TrashIcon } from '@heroicons/vue/solid'
import E from "wangeditor"
import QuillEditor from '@/Shared/QuillEditor'

export default defineComponent({
  props: {
    category: Object,
    tree: Array,
  },
  data () {
    return {
      disclosureDefaultOpen: true,
      form: this.$inertia.form({
        id: this.category.id,
        position: this.category.position,
        name: this.category.name,
        status: this.category.status,
        display_mode: this.category.display_mode,
        description: this.category.description,
        image: this.category.image,
        image_url: this.category.image_url,
        // logo: null,
        attributes: [],
        parent_id: this.category.parent_id,
        slug: this.category.slug,
        meta_title: this.category.meta_title,
        meta_description: this.category.meta_description,
        meta_keywords: this.category.meta_keywords,
      }),
      imagePreview: null,

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
    PhotographIcon,
    TrashIcon,
    QuillEditor
  },
  methods: {
    update () {

      if (this.imagePreview) {
        this.form.image = this.$refs.image.files[0]
      }

      this.form.post(`/admin/catalog/categories/${this.category.id}`, {
        forceFormData: true,
      })
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

    },
    selectNewImage () {
      this.$refs.image.click();
    },
    updateImagePreview () {
      const image = this.$refs.image.files[0];

      if (!image) return;

      const reader = new FileReader();

      reader.onload = (e) => {
        this.imagePreview = e.target.result;
      };

      reader.readAsDataURL(image);
    },

    deleteImage () {

      this.imagePreview = null;
      this.clearImageFileInput();
    },

    clearImageFileInput () {
      if (this.$refs.image?.value) {
        this.$refs.image.value = null;
      }
    },
  },
  mounted () {
    //const editor = new E("#about")
    //editor.create()
  },
  setup () {
    return {
    }
  },
})
</script>