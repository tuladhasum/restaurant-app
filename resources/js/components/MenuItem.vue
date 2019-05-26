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

    <button class="btn btn-primary" type="submit">Save</button>

    <ul>
      <li v-for="(error,index) in errors" :key="index">{{error}}</li>
    </ul>
  </form>
</template>

<script>
  export default {
    name: "MenuItem",
    props: ['initial-categories'],
    data() {
      return {
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
