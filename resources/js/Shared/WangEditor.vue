<template>
  <div>
    <div class="editor"></div>
  </div>
</template>

<script>
import E from 'wangeditor'

export default {
  name: 'editor',
  props: {
    modelValue: Object
  },
  data () {
    return {
      quill: null,
      options: {
        theme: 'snow',
        modules: {
          toolbar: [
            [{ 'size': ['small', false, 'large', 'huge'] }],
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            [{ 'font': [] }],
            // ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            [{ 'indent': '-1' }, { 'indent': '+1' }],
            [{ 'color': [] }],
            [{ 'align': [] }],
            ['clean'],
            ['image']
          ]
        },
        placeholder: '……'
      }
    }
  },
  mounted () {
    // this.quill = new Quill('.editor', this.options);
    // this.quill.setText(this.modelValue)
    // this.quill.on('text-change', () => {
    //   this.$emit('input', this.quill.getContents())
    // });

    const editor = new E('.editor')

    // 设置编辑区域高度为 500px
    editor.config.height = 500

    // 注意，先配置 height ，再执行 create()
    editor.create()
  }
}
</script>
