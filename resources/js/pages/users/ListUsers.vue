<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            Home<a
                                href="http://"
                                target="_blank"
                                rel="noopener noreferrer"
                            ></a>
                        </li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header">
        <div class="container-fluid">
            <!-- Button trigger modal -->
            <button
                type="button"
                class="mb-2 btn btn-primary"
                data-toggle="modal"
                data-target="#createNewUser"
            >
                Add New User
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users" :key="user.id">
                        <th>{{ index + 1 }}</th>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div
        class="modal fade"
        id="createNewUser"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        User Form
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1"
                                >Email address</label
                            >
                            <input
                                v-model="formData.email"
                                type="email"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                placeholder="Enter email"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">User name</label>
                            <input
                                v-model="formData.name"
                                type="text"
                                class="form-control"
                                id="exampleInputPassword1"
                                placeholder="user name"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input
                                v-model="formData.password"
                                type="text"
                                class="form-control"
                                id="exampleInputPassword1"
                                placeholder="user name"
                            />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Close
                    </button>
                    <button
                        type="button"
                        class="btn btn-primary"
                        @click="saveUser"
                    >
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
const users = ref([]);
const formData = reactive({
    name: "",
    email: "",
    password: "",
});
const getUsers = () => {
    axios.get("/api/users").then(({ data }) => {
        console.log(data);
        users.value = data;
    });
};
const saveUser = () => {
    console.log(formData);
    axios
        .post("/api/user/create", formData)
        .then((response) => {
            console.log(response.data);
            users.value.push(response.data);
            formData.name = "";
            formData.email = "";
            formData.password = "";
            $("#createNewUser").modal("hide");
        })
        .catch((error) => {
            console.log(error);
        });
};
onMounted(() => {
    getUsers();
});
</script>
