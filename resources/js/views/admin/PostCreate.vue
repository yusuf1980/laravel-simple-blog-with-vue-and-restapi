<template>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="pl-6 text-xl ">Create Post</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div v-if="errors" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{errors}}</span>
                    </div>
                    <form @submit.prevent>
                        <div class="mb-4">
                            <label class="text-xl text-gray-600">Title <span class="text-red-500">*</span></label><br>
                            <input v-model="form.title" type="text" class="border-2 border-gray-300 p-2 w-full" name="title" id="title" required>
                        </div>

                        <div class="mb-8">
                            <label class="text-xl text-gray-600">Content <span class="text-red-500">*</span></label> <br>
                            <ckeditor :editor="ck.editor" v-model="form.content" :config="ck.editorConfig"></ckeditor>
                        </div>

                        <div class="flex p-1">
                            <select v-model="form.type" class="border-2 border-gray-300 border-r p-2" name="action">
                                <option value="publish">Save and Publish</option>
                                <option value="draft">Save Draft</option>
                            </select>
                            <button @click="submit" role="submit" class="p-3 bg-blue-500 text-white hover:bg-blue-400" required>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {reactive, ref} from 'vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import $axios from '../../axios';
import { useRouter } from 'vue-router';

const router = useRouter()
const form = reactive({
    title: '',
    content: '',
    type: 'publish'
})
const errors = ref('')
const ck = reactive({
    editor: ClassicEditor,
    editorConfig: {
        
    }
})
function submit() {
    if(form.title === '' && form.content === '' ) return alert('Title and Content must filled!')
    console.log(form)

    return new Promise((resolve, reject) => {
		$axios.post('/admin/posts', form)
			.then((response) => {
                console.log(response.data)
				resolve(response)
                router.push('/admin/posts')
			})
			.catch((error) => {
                console.log('error ', error.response)
                if(error.response.status === 422) {
                    errors.value = error.response.data.message
                }
				reject(error.response)
			})
	})
}
</script>

<style>
  .ck-editor__editable {
    min-height: 250px;
   }
</style>