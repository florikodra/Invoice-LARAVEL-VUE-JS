<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Tutte le Fatture</h2>
            </div>
            <div class="card-body">
                <div class="row table-responsive col-12">
                    <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">Data</th>
                            <th scope="col">Riferimento</th>
                            <th scope="col">Tax</th>
                            <th scope="col">Totale</th>
                            <th scope="col">Creato</th>
                            <th scope="col">Aggiornato</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="invoice in invoices" :key="invoice.id" v-on:dblclick="rowClick(invoice.id)" class="customHover">
                            <th scope="row">{{ invoice.id }}</th>
                            <td>{{ invoice.date }}</td>
                            <td>{{ invoice.reference_number }}</td>
                            <td>{{ invoice.tax }}%</td>
                            <td>{{ invoice.total }}</td>
                            <td>{{ formatDate(invoice.created_at) }}</td>
                            <td>{{ formatDate(invoice.updated_at) }}</td>
                            <td class="d-block custom-td">
                                <router-link :to="{name: 'view', params: { id: invoice.id }}" class="btn btn-light rounded-pill"><i class="fas fa-eye"></i></router-link>
                                <router-link :to="{name: 'edit', params: { id: invoice.id }}" class="btn btn-warning rounded-pill"><i class="fas fa-pencil-alt"></i></router-link>
                                <button class="btn btn-outline-danger rounded-pill" @click="deleteInvoice(invoice.id)"><i class="fas fa-trash"></i></button> 
                                <a class="btn btn-outline-dark rounded-pill" :href="'/invoice/pdf/'+invoice.id" target="_blank"><i class="fas fa-file-pdf"></i></a>
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
                .get('/api/invoices/')
                .then(response => {
                    this.invoices = response.data;
                });
        },
        methods: {
            deleteInvoice(id) { 
                if(confirm("Vuoi elimina fatture con id : "+id+"?")){
                    this.axios
                        .delete(`/api/invoices/${id}`)
                        .then(response => {
                            let i = this.invoices.map(data => data.id).indexOf(id);
                            this.invoices.splice(i, 1)
                        });
                }
            },
            rowClick(id){
                this.$router.push({name: 'view',params: { id: id }})
            },
            formatDate(date){
                const today = new Date(date);
                const year = today.getFullYear();
                const month = `${today.getMonth() + 1}`.padStart(2, "0");
                const day = `${today.getDate()}`.padStart(2, "0");

                return day+"."+month+"."+year;
            }
        }
    }
</script>