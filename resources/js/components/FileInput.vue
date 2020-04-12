<template>
    <div>
        <div class="input-group">
            <input type="text" readonly name="input" id="" class="form-control" placeholder="choose your images" :value="getFilesName()">
            <span class="inout-group-btn">
                <button v-if="files.length" type="button" class="btn btn-default" @click="fileClear">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                </button>
                <button class="btn btn-default" type="button" @click="showFilePicker" >
                    <i class="glyphicon glyphicon-paperclip"></i>
                </button>
            </span>
        </div>
        <input type="file" name="" id="" ref="file" style="display:none" @change="onChange" multiple>
    </div>
</template>

<script>
export default {
    props: ['files'],
    methods: {
        clearFiles() {
            this.files = [];
            this.disableUploadButton = true
        },
        showFilePicker() {
            $this.$refs.file.click();
        },
        onChange(event) {
            this.files = event.target.files[0];
            this.$emit('file-change', this.files)
        },
        getFilesName() {
            let filesName = [];
            if (this.files.length > 0) {
                for(let file of this.files) {
                    filesName.push(file.name)
                }
            }
            return filesName.join(", ");
        }
    }
}
</script>