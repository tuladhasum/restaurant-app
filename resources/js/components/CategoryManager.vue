<template>
  <form @submit.prevent="saveCategories">

    <a @click="addCategory" class="add">+ Add Category</a>

    <div v-for="(category, index) in categories" :key="category.id">
      <div class="form-row">

        <div class="form-group col-2">
          <label for="">Display Order</label>
          <input type="text" class="form-control" v-model="category.display_order">
        </div>

        <div class="form-group col-5">
          <label for="">Category Name</label>
          <input type="text" class="form-control" v-model="category.name" :ref="category.name">
        </div>

        <div class="form-group col-4">
          <img v-if="category.image" :src="`/images/${category.image}`" alt="">
          <label v-else>Image: </label>
          <input type="text" class="form-control" v-model.lazy="category.image">
        </div>

        <div class="form-group col-1">
          <a @click="removeCategory(index)" class="btn btn-outline-danger">Delete</a>
        </div>
      </div>
      <hr>
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
    <div>{{feedback}}</div>
  </form>
</template>

<script>
  export default {
    name: "CategoryManager",
    props: ['initialCategories'],
    data() {
      return {
        categories: _.cloneDeep(this.initialCategories),
        feedback: ""
      }
    },
    methods: {
      saveCategories() {
        axios.post('/api/categories/upsert', {
          categories: this.categories
        }).then((res) => {
          if (res.data.success) {
            this.feedback = 'Changes Saved';
            this.categories = res.data.categories;
          }
        });
      },
      removeCategory(index) {
        if (confirm("Are you sure?")) {
          let id = this.categories[index].id;
          if (id > 0) {
            axios.delete('/api/categories/' + id);
          }
          this.categories.splice(index, 1);
        }
      },
      addCategory() {
        this.categories.push({
          id: 0,
          name: "",
          image: "",
          display_order: this.categories.length + 1
        });
        this.$nextTick(() => {
          window.scrollTo(0, document.body.scrollHeight);
          this.$refs[''][0].focus();
        });
      }
    }
  }
</script>

<style scoped>
  img {
    vertical-align: middle;
  }

  hr {
    margin-bottom: 30px;
  }
</style>
