<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Log Out</h1>
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
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div id="info">
        <Form @submit="onSubmit" :validation-schema="schema">
            <Field name="email" type="email" />
            <button>Sign up for newsletter</button>
        </Form>
    </div>
</template>

<script setup>
import { Form, Field } from "vee-validate";
import * as yup from "yup";
const onSubmit = (values) => {
    console.log(values);
};
const schema = yup.object().shape({
    email: yup.string().email().required(),
});
</script>
