<template>
   <div class="container">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2 p-2">
            <button class="btn btn-warning rounded-pill mr-2" type="button" @click="updateInvoice"><i class="fas fa-upload"></i> MODIFICA</button>
            <router-link :to="{name: 'view', params: { id: $route.params.id }}" class="btn btn-primary rounded-pill mr-2" type="button" ><i class="fas fa-eye"></i> VISTA</router-link>
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
                            <!-- <h5>{{ this.data }}</h5> -->
                            <input type="text" class="form-control input-c font-weight-bold" v-model="data">
                        </div>
                        <div class="col">
                            <label>Numero fattura</label>
                            <!-- <h5>{{ this.numeroFattura }}</h5> -->
                            <input type="text" class="form-control input-c font-weight-bold" v-model="numeroFattura">
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
                                <tr v-for="(invoiceItem, index) in invoiceItems" :key="index">
                                    <td> <input type="text" class="form-control mb-1 item-input-c font-weight-bold" placeholder="Nome del prodotto" v-model="invoiceItem.title">
                                        <textarea name="" class="form-control item-input-c" rows="2" placeholder="Descrizione" v-model="invoiceItem.description"></textarea>
                                       
                                    </td>
                                    <td class="text-right"><b class="float-left col-md-6">{{currency}}</b>
                                    <input type="number" step="0.1" class="form-control col-md-6 text-right item-input-c" placeholder="100" v-model="invoiceItem.price">
                                    <div  class="text-center backg-c pt-1 rounded-lg text-white"><label class="custom-check"><input type="checkbox" class="form-check-input" v-model="invoiceItem.fixed" v-on:click="updateQty(index)"> Forfait</label></div>
                                    </td>
                                    <td scope="row" class="text-center">
                                        <input type="number" class="form-control col-md-6 m-auto item-input-c" placeholder="1" v-model="invoiceItem.quantity" v-if="!invoiceItem.fixed">
                                    </td>
                                    <td class="text-right mr-2"><b class="float-left">{{currency}}</b>{{ decimalDigits(invoiceItem.quantity*invoiceItem.price) }}</td>
                                    <button class="btn btn-danger btn-sm rounded-circle mt-3 mr-2" v-on:click="deleteItem(index, invoiceItem.id)" data-html2canvas-ignore="true">X</button>
                                </tr>
                                <button class="btn btn-success rounded-pill mt-3" @click="addRow"> + Aggiungi Prodotto</button>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-end pr-4">
                    <div class="col-lg-4 col-sm-12 col-md-4 pl-2 pr-2 text-lg-center text-sm-center">
                        <div class="row">
                            <div class="row col-7 mb-2">
                                <h5 class="mt-2">IVA</h5>  &nbsp;<input type="number" step=".1" v-model="taxRate" class="form-control col-8 item-input-c">&nbsp;<h5 class="mt-2">%</h5>
                            </div>
                            <div class="col-2">
                                <h5 class="mt-2">{{taxRate}}</h5>
                            </div>
                            <div class="col-3">
                                <h5 class="mt-2">{{decimalDigits(taxTotal)}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mr-4">
                    <div class="col-lg-5 col-sm-12 col-md-4 backg-c text-white rounded-lg pt-3 pb-2 pl-2 pr-2 text-lg-center text-sm-center">
                        <div class="row">
                            <div class="col-4">
                                <h4 class="mt-2">Totale</h4>
                            </div>
                            <div class="col-2">
                                <h4><input type="text" v-model="currency" class="form-control input-c font-weight-bold"></h4>
                            </div>
                            <div class="col-6">
                                <h4 class="mt-2">{{decimalDigits(grandTotal)}}</h4>
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
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2 mb-5">
            <button class="btn btn-warning rounded-pill mr-2" type="button" @click="updateInvoice"><i class="fas fa-upload"></i> MODIFICA</button>
            <router-link :to="{name: 'view', params: { id: $route.params.id }}" class="btn btn-primary rounded-pill mr-2" type="button" ><i class="fas fa-eye"></i> VISTA</router-link>
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
                itemsToDelete: [],
                invoiceItems: [
                    {
                       
                        title: "",
                        description: "",
                        quantity: 1,
                        fixed: false,
                        price: 0
                    }
                ]
            }
        },
        created() {
            this.axios
                .get(`/api/invoices/${this.$route.params.id}`)
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
            updateInvoice() {
                this.axios
                    .patch(`/api/invoices/${this.$route.params.id}`,
                    {
                        data: this.data,
                        company: this.company,
                        customer: this.customer,
                        reference_number: this.numeroFattura,
                        currency: this.currency,
                        tax: this.taxRate,
                        subtotal: this.subtotal,
                        total: this.total,
                        itemsToDelete: this.itemsToDelete,
                        invoiceItems: this.invoiceItems
                    })
                    .then((response) => {
                        this.invoiceItems = response.data.items;
                    }, (error) => {
                        alert("Error, aggiorna e riprova!")
                        console.log(error);
                    });
            },
            decimalDigits(value) {
                return value.toFixed(2);
            },
            addRow(){
                this.invoiceItems.push({
                        id: "",
                        title: "",
                        description: "",
                        quantity: 1,
                        fixed: false,
                        price: ""
                    });
            },
            deleteItem(index, id) {
                this.invoiceItems.splice(index, 1);
                if(id){
                    this.itemsToDelete.push(id);
                }
                
            },
            updateQty(index){
                this.invoiceItems[index].quantity = 1;
            },
            deleteInvoice(){
                if(confirm("Vuoi elimina fatture?")){
                    this.axios
                        .delete(`/api/invoices/${this.$route.params.id}`)
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