<template>
    <div>
        <h2 class="text-center">Invoices List</h2>
 
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Detail</th>
                <!-- <th>Actions</th> -->
            </tr>
            </thead>
            <tbody>
            <tr v-for="invoice in invoices" :key="invoice.id">
                <td>{{ invoice.id }}</td>
                <td>{{ invoice.date }}</td>
                <td>{{ invoice.company }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: invoice.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteProduct(invoice.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                invoices: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/invoices/')
                .then(response => {
                    this.invoices = response.data;
                });
        },
        methods: {
            deleteProduct(id) { 
                this.axios
                    .delete(`http://localhost:8000/api/invoices/${id}`)
                    .then(response => {
                        let i = this.invoices.map(data => data.id).indexOf(id);
                        this.invoices.splice(i, 1)
                    });
            }
        }
    }
</script>