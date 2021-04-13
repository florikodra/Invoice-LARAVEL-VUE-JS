<template>
 <div class="col-lg-12 col-md-12 col-sm-12">

     <div class="card" style="background-image:url('Senery_letterhead-2-empty.jpg'); background-size: cover; height:1527px">
         <div class="card-body" style="margin-top: 180px">
             <div class="row mb-4">
                 <div class="col-sm-4">
                     <textarea name="" class="form-control" style="opacity:.7" rows="3"></textarea>
                     <!-- <div>29, Singla Street</div>
                     <div>Sikeston,New Delhi 110034</div>
                     <div>Email: contact@bbbootstrap.com</div>
                     <div>Phone: +91 9897 989 989</div> -->
                 </div>
                 <div class="col-sm-4">
                 </div>
                 <div class="col-sm-4">
                     <textarea name="" class="form-control" style="opacity:.7" rows="3"></textarea>
                     <!-- <h3 class="text-dark mb-1">Akshay Singh</h3>
                     <div>478, Nai Sadak</div>
                     <div>Chandni chowk, New delhi, 110006</div>
                     <div>Email: info@tikon.com</div>
                     <div>Phone: +91 9895 398 009</div> -->
                 </div>
             </div>
             <div class="row">
             <h3 class="text-center">Fattura</h3>
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
                                <input type="text" name="title" class="form-control" style="margin-bottom: 3px" placeholder="Item title" v-model="invoiceItem.title">
                                <textarea name="" id="" rows="2" class="form-control"></textarea>
                             </td>
                             <td class="center">$</td>
                             <td class="right"><input type="number" name="price" class="form-control" min="0.00" value="0.00" step="0.1" v-model="invoiceItem.price"></td>
                             <td class="center"><input type="number" name="quantity" class="form-control" v-model="invoiceItem.quantity"></td>
                             <td class="center">$</td>
                             <td class="right">{{ invoiceItem.quantity*invoiceItem.price }}
                             <button class="btn btn-danger btn-sm float-right" @click="removeRow(invoiceItem)">x</button></td>
                         </tr>

                         <button class="btn btn-success" @click="addRow">Add Row</button>
                       
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
                                 <td class="right">{{ total }}</td>
                             </tr>

                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">IVA 7.7%</strong>
                                 </td>
                                 <td class="right">{{ total*0.077 }}</td>
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Total</strong> </td>
                                 <td class="right">
                                     <strong class="text-dark">{{ total+0.077*total }}</strong>
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
        total(){
            return this.invoiceItems.reduce(
                (acc, invoiceItem) => acc + invoiceItem.price * invoiceItem.quantity, 0
            );
        }

    },
    methods: {
        addInvoice() {
            this.axios
                .post("http://localhost:8000/api/invoices", this.invoice)
                .then(response => this.$router.push({ name: "/" }))
                .catch(err => console.log(err))
                .finally(() => (this.loading = false));
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
