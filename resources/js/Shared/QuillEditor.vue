<template>
  <div>
    <div class="editor min-h-min">
    </div>
  </div>
</template>

<script>
import Quill from 'quill'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

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
    //let dom = this.$el.querySelector('.editor')
    // this.quill = new Quill('.editor', this.options);
    // this.quill.setContents(this.modelValue)
    // this.quill.on('text-change', () => {
    //   this.$emit('input', this.quill.getContents())
    // });

    var quill = new Quill('.editor', this.options);

    quill.setContents(this.modelValue)



    quill.on('text-change', () => {
      console.log(quill.getContents)
      this.$emit('input', '11111')
    });

    // quill.setContents([
    //   { insert: 'Hello ' },
    //   { insert: 'World!', attributes: { bold: true } },
    //   { insert: '\n' }
    // ]);
  }
}
</script>
