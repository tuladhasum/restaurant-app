<template>
  <section>
    <h1>Menu Editor</h1>
    <router-link :to="{name: 'categories'}">Categories</router-link>
    <router-link :to="{name: 'add-item'}">Add Item</router-link>
    <router-view :initial-categories="categories"></router-view>
  </section>
</template>

<script>
  import VueRouter from 'vue-router';
  import CategoryManager from './CategoryManager';
  import MenuItem from './MenuItem';

  export default {
    name: "MenuEditor",
    props: ['categories'],
    router: new VueRouter({
      base: 'menu-editor',
      mode: 'history',
      routes: [
        {
          path: '/categories',
          name: 'categories',
          component: CategoryManager
        },
        {
          path: '/',
          redirect: {name: 'categories'}
        },
        {
          path: '/add-item',
          name: 'add-item',
          component: MenuItem
        },
        {
          path: '*',
          redirect: '/'
        }
      ]
    })
  }
</script>

<style scoped>
a{
  border: solid 1px black;
  padding: 10px;
  margin: 0;
}
  .router-link-active{
    font-weight: bold;
    border-bottom: none;
  }
</style>
