<template>
    <form @submit.prevent="handleSubmit">
        <div class="form-group">
            <label for="">Image</label>
            <file-input :files="files" v-on:file-change="setFiles" @file-clear="clearFiles"></file-input>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success" :disabled="disableUploadButton">Upload</button>
        </div>
            <progress-bar :progress="progress" v-if="isUploading"></progress-bar>
    </form>
</template>

<script>
import ProgressBar from './ProgressBar.vue'
import FileInput from './FileInput.vue'
export default {
    components: {
        FileInput,
        ProgressBar
    },
    data() {
        return {
            files: '',
            progress: 0,
            isUploading: false,
            disableUploadButton: true
        }
    },
    methods: {
        clearFiles() {
            this.files = [];
            this.disableUploadButton = true
        },
        handleSubmit() {
            this.isUploading = true;
            this.disableUploadButton = true;
            let fromData = new FormData();
            for(let file of this.files) {
                FormData.append('file_name[]', file, file.name)
            }
            FormData.append('file_name[]', this.files)
            axios.post('/', FormData, {
                onUploadProgress: e => {
                    if(e.lengthComputable) {
                        this.progress = (e.loaded / e.total) * 100
                        
                    }
                }
            })
            .then((res) =>{
                console.log(res)
                setTimeout(()=> {
                    this.isUploading = false;
                    this.files = []
                }, 1000)
            })
            .catch((err) => {
                console.log(err)
            })

            }
        },
        setFiles(files) {
            if(files === undefined) {
                this.files = files
                this.disableUploadButton = false
            }
        }
    }
</script>