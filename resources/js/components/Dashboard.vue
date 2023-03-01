<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="test">
        <Form
            @submit="saveUser"
            :validation-schema="schema"
            v-slot="{ errors }"
        >
            <Field name="name" type="text" placeholder="user name" />
            <br />
            <span>{{ errors.name }}</span>
            <br />
            <Field
                name="password"
                type="password"
                placeholder="user password"
            /><br />
            <span>{{ errors.password }}</span>
            <br />
            <button type="submit">Submit</button>
        </Form>
    </div>
</template>
<script setup>
import { Field, Form } from "vee-validate";
import * as yup from "yup";
const schema = yup.object({
    name: yup.string().required(),
    password: yup.string().required().min(4),
});
const saveUser = (values) => {
    console.log(values);
};
</script>
