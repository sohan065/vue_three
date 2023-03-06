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
                @click="addNewUser()"
            >
                Add New User
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Registration Date</th>
                        <th scope="col">Role</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users" :key="user.id">
                        <th>{{ index + 1 }}</th>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>...</td>
                        <td>...</td>
                        <td>
                            <a @click.prevent="editUser(user)"
                                ><i class="fa fa-edit"></i
                            ></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <Form
        @submit="handleSubmit"
        :validation-schema="editing ? editUserSchema : storeUserSchema"
        v-slot="{ errors }"
        :initial-values="formValues"
    >
        <div
            class="modal fade"
            id="userForm"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <span v-if="editing">Edit User</span>
                            <span v-else>Add User</span>
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
import { useToastr } from "../../toasts";

const toastr = useToastr();
const users = ref([]);
const editing = ref(false);
const formValues = ref();

// const formData = reactive({
//     name: "",
//     email: "",
//     password: "",
// });

const handleSubmit = (values, actions) => {
    if (editing.value) {
        updateUser(values, actions);
    } else {
        storeUser(values, actions);
    }
};
const addNewUser = () => {
    editing.value = false;
    $("#userForm").modal("show");
};
const getUsers = () => {
    axios.get("/api/users").then(({ data }) => {
        users.value = data;
    });
};
const editUser = (user) => {
    editing.value = true;
    $("#userForm").modal("show");
    formValues.value = {
        id: user.id,
        name: user.name,
        email: user.email,
    };
};
const storeUserSchema = yup.object({
    name: yup.string().required(),
    email: yup.string().email().required(),
    password: yup.string().min(4).required(),
});
const editUserSchema = yup.object({
    name: yup.string().required(),
    email: yup.string().email().required(),
    password: yup.string().min(4).required(),
});

const updateUser = (values, { resetForm }) => {
    axios
        .post("/api/user/update", values)
        .then((response) => {
            // users.value.unshift(response.data);
            console.log(response);
            $("#userForm").modal("hide");

            resetForm();
        })
        .catch((error) => {
            console.log(error);
        })
        .finally
        // (formValues.value = {
        //     id: "",
        //     name: "",
        //     email: "",
        // })
        ();
};
const storeUser = (values, { resetForm, setErrors }) => {
    axios
        .post("/api/user/create", values)
        .then((response) => {
            users.value.unshift(response.data);
            toastr.success("success");
            $("#userForm").modal("hide");
            resetForm();
        })
        .catch((error) => {
            setErrors(error.response.data.errors);
        });
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
