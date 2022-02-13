<template>
  <div class="row todo-content">
    <div class="col-md-6">
      <div class="todo-list not-done">
        <h1>CRUD VUEJS</h1>
        <div class="input-group mb-3">
          <input
            type="text"
            class="form-control"
            v-model="textcontent"
            placeholder="Enter content"
          />
          <div class="input-group-append">
            <button
              class="btn btn-outline-secondary btn-success"
              type="button"
              @click="addTask()"
              id="button-addon2"
            >
              Add
            </button>
          </div>
        </div>
        <hr />
        <ul class="list-unstyled">
          <li
            v-for="(todo) in todos"
            :key="todo.id"
            class="ui-state-default li-items mt-1"
          >
            <div class="input-group">
              <input
                v-model="todo.content"
                type="text"
                class="form-control"
              />
              <div class="input-group-append remove-icon">
                <span @click="delTask(todo.id)" class="input-group-text del"
                  >Del</span>
                <span class="input-group-text del"
                  ><router-link :to="{name: 'Edit', params: { id: todo.id }}">Edit</router-link></span>
              </div>
            </div>
          </li>
        </ul>
        <hr />
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Todolist",
  data: function () {
    return {
      todos: [],
      textcontent: "",
    };
  },
  created() {
    axios.get(`http://127.0.0.1:8000/api/todos`).then((response) => {
      this.todos = response.data.data;
    });
  },
  methods: {
    addTask: function () {
      if (this.textcontent.trim().length == 0) {
        return;
      }
      let param = {
        content: this.textcontent,
      };
      axios.post(`http://127.0.0.1:8000/api/todos`, param).then((response) => {
        this.todos = response.data.data;
      });
      this.textcontent = "";
    },
    delTask: function (index) {
      if (confirm("Bạn có muốn xóa không")) {
        axios.delete("http://127.0.0.1:8000/api/todos/" + index)
          .then((response) => {
            this.todos = response.data.data;
          });
      }
    },
  },
};
</script>

<style scoped>
.todo-content {
  display: flex;
  justify-content: center;
}

.todo-list h1 {
  margin-top: 20px;
  padding-bottom: 20px;
  text-align: center;
  font-weight: bold;
}

.todo-footer {
  background-color: #d2e8ca;
  padding: 10px 20px 15px;
}

#done-items li {
  padding: 10px 0;
  border-bottom: 1px solid #ddd;
  text-decoration: line-through;
}

.done-task {
  text-decoration: line-through;
  color: orange;
}

.form-check-inline {
  cursor: pointer;
}

.remove-icon span {
  cursor: pointer;
}

.save-all {
  float: right;
}
.del{
  color: red;
}
.edit{
  color: blue;
}
.btn{
  color: white;
}
router-link{
  text-decoration: none;
}
</style>
