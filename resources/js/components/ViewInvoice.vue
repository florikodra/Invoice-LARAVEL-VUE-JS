<template>
   <div class="container">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2 text-center">
            <a class="btn btn-danger rounded-pill mr-2" :href="'/invoice/pdf/'+$route.params.id" target="_blank"><i class="fas fa-file-pdf"></i> PDF</a>
            <router-link :to="{name: 'edit', params: { id: $route.params.id }}" class="btn btn-warning rounded-pill mr-2" type="button" ><i class="fas fa-pencil-alt"></i> MODIFICA</router-link>
            <button class="btn btn-danger rounded-pill" type="button" @click="deleteInvoice" ><i class="fas fa-trash"></i> ELIMINA</button>

        </div>
        <div class="card">
            <div class="card-header fill">
                <img src="/pdf-header.jpg" alt="" />
            </div>
            <div class="card-body ml-3 mr-3 text-secondary"  ref="document">
                <div class="row justify-content-between mb-5">
                    <div class="col-lg-4 col-sm-12 col-md-6" >
                        <textarea rows="5" class="form-control item-input-c" v-model="company"></textarea>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-6 text-lg-right">
                        <textarea rows="5" class="form-control item-input-c text-md-right" v-model="customer"></textarea>
                    </div>
                </div>

                <h2 class="text-secondary mb-3 font-weight-bold">Fattura</h2>
                <div class="col-lg-4 col-sm-12 col-md-4 backg-c text-white rounded-lg pt-2 pb-2 pl-4 pr-4">
                    <div class="row">
                        <div class="col">
                            <label>Data</label>
                            <h5>{{ data }}</h5>
                           <!--  <input type="text" name="" id="" class="form-control input-c font-weight-bold" v-model="data"> -->
                        </div>
                        <div class="col">
                            <label>Numero fattura</label>
                            <h5>{{ numeroFattura }}</h5>
                            <!-- <input type="text" name="" id="" class="form-control input-c font-weight-bold" v-model="numeroFattura"> -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-3 col-sm-12">
                    <div class="table-responsive row">
                        <table class="table table-striped">
                            <thead class="color-c font-weight-bold">
                                <tr>
                                    <th scope="col" style="width:50%">Descrizione</th>
                                    <th scope="col" class="text-right">Prezzo</th>
                                    <th scope="col" class="text-center">Quantità</th>
                                    <th scope="col" class="text-right">Totale</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(invoiceItem, index) in invoiceItems" :key="index" class="text-secondary">
                                    <td>
                                        <h6 class="font-weight-bold text-secondary">{{invoiceItem.title}}</h6>
                                        <p class="text-secondary">{{invoiceItem.description}}</p>
                                       
                                    </td>
                                    <td class="text-right"><b class="float-left col-md-6" v-if="invoiceItem.fixed==0">{{currency}}</b>
                                    <span v-if="invoiceItem.fixed==0">{{invoiceItem.price}}</span>
                                    </td>
                                    <td scope="row" class="text-center">
                                        <span v-if="invoiceItem.fixed==0">{{invoiceItem.quantity}}</span>
                                        <span v-else>forfait</span>
                                    </td>
                                    <td class="text-right mr-2"><b class="float-left">{{currency}}</b>{{ decimalDigits(invoiceItem.quantity*invoiceItem.price) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-end pr-4">
                    <div class="col-lg-4 col-sm-12 col-md-4 pl-2 pr-2 text-lg-center text-sm-center">
                        <div class="row">
                            <div class="col-3 mb-2 col-sm-3">
                                <h5 class="mt-2">IVA</h5>
                            </div>
                            <div class="col-4 col-sm-6">
                                <h5 class="mt-2">{{taxRate}}%</h5>
                            </div>
                            <div class="col-5 col-sm-3">
                                <h5 class="mt-2">{{decimalDigits(taxTotal)}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mr-lg-4">
                    <div class="col-lg-5 col-sm-12 col-md-4 backg-c text-white rounded-lg pt-3 pb-2 pl-2 pr-2 text-lg-center text-sm-center">
                        <div class="row">
                            <div class="col-4">
                                <h4>Totale</h4>
                            </div>
                            <div class="col-2">
                                <h4>{{currency}}</h4>
                            </div>
                            <div class="col-6">
                                <h4>{{decimalDigits(grandTotal)}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mr-4">
                    <strong>Grazie per la vostra fiducia e cordiali saluti.</strong>
                </div>



            </div>
            <div class="card-footer fill">
                <img src="/pdf-footer.jpg" alt="" />
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2 mb-5 text-center">
            <a class="btn btn-danger rounded-pill mr-2" :href="'/invoice/pdf/'+$route.params.id" target="_blank"><i class="fas fa-file-pdf"></i> PDF</a>
            <router-link :to="{name: 'edit', params: { id: $route.params.id }}" class="btn btn-warning rounded-pill mr-2" type="button" ><i class="fas fa-pencil-alt"></i> MODIFICA</router-link>
            <button class="btn btn-danger rounded-pill" type="button" @click="deleteInvoice" ><i class="fas fa-trash"></i> ELIMINA</button>

        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                invoice: {},
                data: "",
                numeroFattura: "",
                currency: "",
                company: "",
                customer: "",
                subtotal: "",
                taxtotal: 0,
                taxRate: "",
                total: 0,
                toUpdate: false,
                invoiceItems: [
                    {
                        id: "",
                        title: "",
                        description: "",
                        quantity: 1,
                        price: 0
                    }
                ]
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/invoices/${this.$route.params.id}`)
                .then((res) => {
                    this.invoice = res.data.invoice;
                    this.data = res.data.invoice.date;
                    this.numeroFattura = res.data.invoice.reference_number;
                    this.company = res.data.invoice.company;
                    this.customer = res.data.invoice.reference_person;
                    this.currency = res.data.invoice.currency;
                    this.taxRate = res.data.invoice.tax;
                   this.invoiceItems = res.data.items;
                });
        },
        computed: {
            subTotal() {
                var total = this.invoiceItems.reduce(function(accumulator, invoiceItem) {
                    return accumulator + (invoiceItem.price * invoiceItem.quantity);
                }, 0);
                this.subtotal = total;
                return total;
            },

            taxTotal: function() {
                var total = this.subTotal * (this.taxRate / 100);
                return total;
            },

            grandTotal: function() {
                var total = this.subTotal + this.taxTotal;
                this.total = total;
                return total;
            }

        },
        methods: {
            updateProduct() {
                this.axios
                    .patch(`http://localhost:8000/api/invoices/${this.$route.params.id}`, this.invoice)
                    .then((res) => {
                        this.$router.push({ name: 'home' });
                    });
            },
            decimalDigits(value) {
                return value.toFixed(2);
            },
            deleteInvoice(){
                if(confirm("Vuoi elimina fatture?")){
                    this.axios
                        .delete(`http://localhost:8000/api/invoices/${this.$route.params.id}`)
                        .then((response) => {
                            this.$router.push({name: 'invoices'});
                        }, (error) => {
                            alert("Error, aggiorna e riprova!")
                            console.log(error);
                        });
                }
            }
        }
    }
</script>