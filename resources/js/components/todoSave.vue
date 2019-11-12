
<template>
  <b-form class="d-flex align-items-center flex-column" @submit.prevent="save">
    <slot>
      <h4>Save Todo</h4>
    </slot>
    <b-form-group id="input-group-1" class="w-100">
      <b-form-input id="input-1" v-model="todo.title" type="text" required placeholder="Your task"></b-form-input>
    </b-form-group>

    <b-form-group id="input-group-2" class="w-100">
      <b-form-textarea
        id="input-2"
        v-model="todo.description"
        type="text"
        placeholder="Task description"
      ></b-form-textarea>
    </b-form-group>

    <b-form-group
      id="input-group-3"
      class="w-100"
      label="Deadline:"
      label-for="input-3"
      description="Enter the deadline for your task, leave empty if there is no time limit."
    >
      <b-form-input
        id="input-3"
        v-model="todo.dateline"
        type="datetime-local"
        placeholder="deadline"
      ></b-form-input>
    </b-form-group>

    <b-button class="w-50" type="submit" variant="success">Save</b-button>
  </b-form>
</template>

<script>
export default {
  props: {
    empty: {
      type: Boolean,
      default: true
    },
    todo: {
      type: Object,
      default: () => ({
        id: null,
        title: "",
        description: "",
        state: 0,
        dateline: null
      })
    }
  },
  data: function() {
    return {};
  },
  methods: {
    save(e) {
      this.$emit("submit", this.todo);
      if (this.empty) this.clean();
    },
    clean() {
      this.todo.id = null;
      this.todo.title = "";
      this.todo.description = "";
      this.todo.state = 0;
      this.todo.dateline = null;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>