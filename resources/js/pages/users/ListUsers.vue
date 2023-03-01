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
    <Form @submit="saveUser" :validation-schema="schema" v-slot="{ errors }">
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
                        <!-- <form> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1"
                                >Email address</label
                            >
                            <Field
                                name="email"
                                type="email"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                placeholder="Enter email"
                            />
                            <span>{{ errors.email }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">User name</label>
                            <Field
                                name="name"
                                type="text"
                                class="form-control"
                                id="exampleInputPassword1"
                                placeholder="user name"
                            />
                            <span>{{ errors.name }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <Field
                                name="password"
                                type="text"
                                class="form-control"
                                id="exampleInputPassword1"
                                placeholder="user name"
                            />
                            <span>{{ errors.password }}</span>
                        </div>
                        <!-- </form> -->
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Form>
</template>

<script setup>
import axios from "axios";
import { Field, Form } from "vee-validate";
import * as yup from "yup";
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

const schema = yup.object({
    name: yup.string().required(),
    email: yup.string().email().required(),
    password: yup.string().min(4).required(),
});
const saveUser = (values) => {
    console.log(values);
};
// const saveUser = () => {
//     console.log(formData);
//     axios
//         .post("/api/user/create", formData)
//         .then((response) => {
//             console.log(response.data);
//             users.value.push(response.data);
//             formData.name = "";
//             formData.email = "";
//             formData.password = "";
//             $("#createNewUser").modal("hide");
//         })
//         .catch((error) => {
//             console.log(error);
//         });
// };
onMounted(() => {
    getUsers();
});
</script>
