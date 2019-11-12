<template>
  <li
    class="px-0 py-0"
    @click.stop="$router.push({name: 'tasks', params: { id: todo.id, todo: todo, heading: 'Edit Todo', empty:false } })"
  >
    <h6 class="d-flex mb-0 pl-2 text-capitalize">
      <b-input-group class>
        <span class="py-2 d-flex">{{todo.title}}</span>
        <a
          class="ml-auto text-decoration-none toggler px-3 py-2"
          v-b-toggle="todo.id+'-desc'"
          @click.stop
        >
          <i class="fas fa-angle-down text-bold fa-lg"></i>
        </a>

        <b-input-group-append @click.stop="$emit('delete', todo.id)">
          <b-button class variant="danger">
            <i class="fas fa-times text-white"></i>
          </b-button>
        </b-input-group-append>
      </b-input-group>
    </h6>
    <b-collapse
      class="border-top pt-3 px-3 pb-2 text-capitalize text-muted"
      :id="todo.id+'-desc'"
      :accordion="parent"
    >
      <span class="d-block">{{todo.description}}</span>
      <small
        class="font-weight-lighter d-block text-right mt-2"
      >{{ todo.dateline ? "deadline : "+todo.dateline : ""}}</small>
    </b-collapse>
  </li>
</template>

<script>
export default {
  name: "todo-item",
  props: {
    todo: Object,
    parent: String
  },
  data: function() {
    return {};
  },
  methods: {
    format(date) {}
  }
};
</script>