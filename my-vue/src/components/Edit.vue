<template>
  <div class="container">
      <form @submit.prevent="updateTodo">
           <div class="input-group mb-3">
      <input type="text" class="form-control" v-model="todo.content" />
      <div class="input-group-append">
        <button
          class="btn btn-outline-secondary"
          type="submit"
          id="button-addon2">
          Update
        </button>
      </div>
    </div>
      </form>
  </div>
</template>
<script>
import axios from "axios";
export default {
        name: "Edit",
  data: function () {
    return {
      todo: [],
    };
  },
  created() {
    axios.get(`http://127.0.0.1:8000/api/todos/${this.$route.params.id}`).then((response) => {
      this.todo = response.data;
    });
  },
  methods: {
            updateTodo () {
                axios.patch(`http://127.0.0.1:8000/api/todos/${this.$route.params.id}`, this.todo)
                    .then((response) => {
                        this.$router.push({ name: 'Todolist' });
                    });
            }
        }
}
</script>
<style scoped>
input,
button {
  margin-top: 50px;
}
</style>
