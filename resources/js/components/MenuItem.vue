<template>
  <form @submit.prevent="save" class="p-5" novalidate>
    <div class="form-group">
      <label for="">Item Name: </label>
      <input type="text" placeholder="Item Name" v-model="item.name" required class="form-control">
    </div>

    <div class="form-group">
      <label for="">Price</label>
      <input type="number" min="0" step=".01" v-model="item.price" required class="form-control w-100">
    </div>

    <div class="form-group">
      <label for="">Description</label>
      <textarea class="form-control" v-model="item.description" placeholder="Item description" required cols="30"
                rows="5"></textarea>
    </div>

    <div class="form-group">
      <label for="">Category</label>
      <select class="form-control" v-model="item.category_id" required>
        <option value="">Select a category</option>
        <option v-for="cat in initialCategories" :value="cat.id" :key="cat.id">{{cat.name}}</option>
      </select>
    </div>

    <drop-zone :options="dropzoneOptions" id="dz" ref="dropzone"></drop-zone>

    <button class="btn btn-primary" type="submit">Save</button>

    <ul>
      <li v-for="(error,index) in errors" :key="index">{{error}}</li>
    </ul>
  </form>
</template>

<script>
  import vue2Dropzone from 'vue2-dropzone';
  import 'vue2-dropzone/dist/vue2Dropzone.min.css'

  export default {
    components: {
      dropZone: vue2Dropzone
    },
    name: "MenuItem",
    props: ['initial-categories'],
    data() {
      return {
        dropzoneOptions: {
          // url: '/api/add-image',
          url: 'https://api.cloudinary.com/v1_1/sumit270/image/upload',
          thumbnailWidth: '200',
          header: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
          },
          sending(file, xhr, formData){
            formData.append('api_key', 837962715986897);
            formData.append('timestamp', Date.now() / 1000 | 0);
            formData.append('upload_preset', 'vajraRestaurant');
          },
          success(file,res){
            // console.log(res);
            // console.log(file);
            file.filename = res;
            // console.log('Success! Cloudinary public ID is', res.public_id);
          }
        },
        item: {
          name: "",
          price: 0.00,
          description: "",
          category_id: ""
        },
        errors: []
      }
    },
    methods: {
      save() {
        let files = this.$refs.dropzone.getAcceptedFiles();
        // console.log(files);
        // Grab cloudinary return filename.url
        if(files.length > 0 && files[0].filename.url){
          this.item.image = files[0].filename.url;
        }
        axios.post('/api/menu-items/add', this.item)
          .then(res => {
            this.$router.push('/');
            console.log(res);
          })
          .catch(error => {
            console.log(error.response.data.errors);
            let messages = Object.values(error.response.data.errors);
            this.errors = [].concat.apply([], messages);
          });
      }
    }
  }
</script>

<style scoped>

</style>
