<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Invoices List</h2>
            </div>
            <div class="card-body">
                <div class="row table-responsive col-12">
                    <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">Data</th>
                            <th scope="col">Riferimento</th>
                            <th scope="col">Totale</th>
                            <th scope="col">Creato</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="invoice in invoices" :key="invoice.id">
                            <th scope="row">{{ invoice.id }}</th>
                            <td>{{ invoice.date }}</td>
                            <td>{{ invoice.reference_number }}</td>
                            <td>{{ invoice.total }}</td>
                            <td>{{ invoice.created_at }}</td>
                            <td>
                                <router-link :to="{name: 'view', params: { id: invoice.id }}" class="btn btn-outline-primary rounded-pill"><i class="fas fa-eye"></i></router-link>
                                <button class="btn btn-outline-danger rounded-pill" @click="deleteInvoice(invoice.id)"><i class="fas fa-trash"></i></button> 
                                <button class="btn btn-outline-dark rounded-pill"><i class="fas fa-file-pdf"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
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
            deleteInvoice(id) { 
                if(confirm("Vuoi elimina fatture con id : "+id+"?")){
                    this.axios
                        .delete(`http://localhost:8000/api/invoices/${id}`)
                        .then(response => {
                            let i = this.invoices.map(data => data.id).indexOf(id);
                            this.invoices.splice(i, 1)
                        });
                }
            }
        }
    }
</script>