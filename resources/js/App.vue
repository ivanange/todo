<template>
  <div id="app" class="d-flex flex-column justify-content-center align-items-center">
    <router-view name="title"></router-view>
    <router-view class="list" :list="todos" :id="'list'" @delete="deleteTodo" name="list"></router-view>
    <router-view class="create-form" @submit="saveTodo" name="save">
      <h4>{{ $route.params.heading || "Create Todo" }}</h4>
    </router-view>
  </div>
</template>

<script>
export default {
  data: () => ({
    section: "Home",
    url: "/api/todos",
    todosList: []
  }),
  computed: {
    todos: function() {
      return [...this.todosList].sort(
        (a, b) => new Date(b.created_at) - new Date(a.created_at)
      );
    },
    pending: function() {
      return this.todos.filter(el => el.state == this.$pending);
    },
    done: function() {
      return this.todos.filter(el => el.state == this.$done);
    },
    late: function() {
      return this.todos.filter(
        el => new Date() > (el.dateline ? new Date(el.dateline) : new Date())
      );
    }
  },
  watch: {},
  methods: {
    alert: function(message, event) {
      // now we have access to the native event
      if (event) event.preventDefault();
      alert(message);
    },

    goBack() {
      window.history.length > 1 ? this.$router.go(-1) : this.$router.push("/");
    },

    saveTodo(todo) {
      let index = -1;
      axios.post(this.url, JSON.stringify(todo)).then(el => {
        if ((index = this.todosList.findIndex(e => e.id == todo.id)) > 0) {
          this.todosList[index] = el.data;
        } else {
          this.todosList.unshift(el.data);
        }
      });
    },
    deleteTodo(id) {
      axios
        .delete(`${this.url}/${id}`)
        .then(
          el => (this.todosList = this.todosList.filter(item => item.id != id))
        );
    }
  },
  created: function() {
    axios
      .get(this.url)
      .then(res => (this.todosList = res.data))
      .catch(err => console.error(err));
  }
};
</script>

<style lang="scss">
@import "node_modules/bootstrap/scss/bootstrap";
@import "node_modules/bootstrap-vue/src/index.scss";

.list {
  > li {
    width: 500px;
  }

  height: calc(100vh - 400px);
  overflow-y: auto;
}

.create-form {
  width: 400px;
}
</style>