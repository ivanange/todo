<template>
  <ul v-if="list.length" class="list-group text-dark my-3 px-2" :id="id">
    <todoItem
      v-for="todo in list"
      :todo="todo"
      :key="todo.id"
      :parent="id"
      @delete="$emit('delete', $event)"
      class="list-group-item my-2 rounded"
    />
  </ul>
</template>

<script>
import todoItem from "./todoItem.vue";

export default {
  components: {
    todoItem
  },
  props: {
    list: Array,
    id: String
  },
  data: function() {
    return {};
  }
};
</script>