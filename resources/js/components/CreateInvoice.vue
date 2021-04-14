<template>
 <div class="col-lg-12 col-md-12 col-sm-12">

     <div class="row">
        <div class="col-lg-2 text-left button-head-c">
            <button class="btn btn-success rounded-pill button-c mt-1" @click="addInvoice"><i class="fas fa-save"></i> SAVE AND EXIT</button>
            <button class="btn btn-success rounded-pill button-c mt-1">SAVE AND CREATE NEW</button>
            <button class="btn btn-primary rounded-pill button-c mt-1"><i class="fas fa-download"></i> DOWNLOAD PDF</button>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                <label>Currency: </label>
                <input type="text" class="form-control" v-on:keyup="addCurrency" v-model="this.currency">
            </div>
            <div class="col-lg-6">
                <label>IVA: </label>
            <input type="text" class="form-control" v-on:keyup="addVat" v-model="this.iva" >
            </div>
            </div>
            
            
            
        </div>
     </div>
     <br>

     <div class="card card-c">
         <div class="card-body card-body-c">
             <div class="row mb-4">
                 <div class="col-sm-4">
                     <textarea name="" class="form-control textarea-c" rows="3"></textarea>
                     <!-- <div>29, Singla Street</div>
                     <div>Sikeston,New Delhi 110034</div>
                     <div>Email: contact@bbbootstrap.com</div>
                     <div>Phone: +91 9897 989 989</div> -->
                 </div>
                 <div class="col-sm-4">
                 </div>
                 <div class="col-sm-4">
                     <textarea name="" class="form-control textarea-c" rows="3"></textarea>
                     <!-- <h3 class="text-dark mb-1">Akshay Singh</h3>
                     <div>478, Nai Sadak</div>
                     <div>Chandni chowk, New delhi, 110006</div>
                     <div>Email: info@tikon.com</div>
                     <div>Phone: +91 9895 398 009</div> -->
                 </div>
             </div>
             <h1 class="text-center text-primary m-3">FATTURA</h1>
             <div class="row">
             
             </div>
             <div class="table-responsive-sm">
                 <table class="table">
                     <thead>
                         <tr>
                             <th colspan="2" style="width:45%">Descrizione</th>
                             <th class="right" style="width:15%">Prezzo</th>
                             <th class="center" colspan="2" style="width:15%">Quantità</th>
                             <th class="right" >Totale</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr v-for="invoiceItem in invoiceItems" v-bind:key="invoiceItem">
                             <td class="left">
                                <input type="text" name="title" class="form-control" style="margin-bottom: 3px" placeholder="Nome" v-model="invoiceItem.title">
                                <textarea name="" id="" rows="2" class="form-control" placeholder="Descrizione"></textarea>
                             </td>
                             <td class="center">{{currency}}</td>
                             <td class="right"><input type="number" name="price" class="form-control" min="0.00" value="0.00" step="0.1" v-model="invoiceItem.price" placeholder="100.00"></td>
                             <td class="center"><input type="number" name="quantity" class="form-control" v-model="invoiceItem.quantity"></td>
                             <td class="center">{{currency}}</td>
                             <td class="right">{{ invoiceItem.quantity*invoiceItem.price }}
                             <button class="btn btn-danger btn-sm float-right rounded-circle" @click="removeRow(invoiceItem)">X</button></td>
                         </tr>

                         <button class="btn btn-success" @click="addRow"> + Add Row</button>
                       
                     </tbody>
                 </table>
             </div>
             <div class="row">
                 <div class="col-lg-4 col-sm-5">
                 </div>
                 <div class="col-lg-4 col-sm-5 ml-auto">
                     <table class="table table-clear">
                         <tbody>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Subtotal</strong>
                                 </td>
                                 <td class="right">{{currency}} {{ subtotal }}</td>
                             </tr>

                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">IVA {{this.iva}}%</strong>
                                 </td>
                                 <td class="right">{{currency}} {{ tax }}</td>
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Total</strong> </td>
                                 <td class="right">
                                     <strong class="text-dark">{{currency}} {{ totalInvoice }}</strong>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
         
     </div>

     
     
 </div>
</template>

<script>
export default {
    data() {
        return {
            invoice: {},
            subtotal: 0,
            tax: 0,
            total: 0,
            iva: 7.7,
            currency: "$",
            invoiceItems: [
                {
                    title: "",
                    description: "",
                    quantity: 1,
                    price: ""
                }
            ]
        };
    },
    computed: {
        totalInvoice(){
            this.subtotal = this.invoiceItems.reduce(
                (acc, invoiceItem) => acc + invoiceItem.price * invoiceItem.quantity, 0
            );
            this.tax = this.subtotal*(this.iva/100);
            this.total = this.tax + this.subtotal;
            return this.total;
        }

    },
    methods: {
        addVat(evt){
            this.iva=evt.target.value;
        },
        addCurrency(evt){
            this.currency = evt.target.value;
        },
        addInvoice() {
           /*  this.axios
                .post("http://localhost:8000/api/invoices", this.invoice)
                .then(response => this.$router.push({ name: "/" }))
                .catch(err => console.log(err))
                .finally(() => (this.loading = false)); */

            this.invoiceItems= [
                {
                    title: "",
                    description: "",
                    quantity: 1,
                    price: ""
                }
            ];
        },
        addRow(){
            this.invoiceItems.push({
                    title: "",
                    description: "",
                    quantity: 1,
                    price: ""
                });
        },
        removeRow(){
            this.invoiceItems.slice(this.invoiceItem);
        }
    }
};
</script>
