<template>
 <div class="col-lg-12 col-md-12 col-sm-12">

     <div class="card" style="background-image:url('Senery_letterhead-2-empty.jpg'); background-size: cover; height:1527px">
         <div class="card-body" style="margin-top: 180px">
             <div class="row mb-4">
                 <div class="col-sm-4">
                     <textarea name="" class="form-control" style="opacity:.7"></textarea>
                     <!-- <div>29, Singla Street</div>
                     <div>Sikeston,New Delhi 110034</div>
                     <div>Email: contact@bbbootstrap.com</div>
                     <div>Phone: +91 9897 989 989</div> -->
                 </div>
                 <div class="col-sm-4">
                 </div>
                 <div class="col-sm-4">
                     <textarea name="" class="form-control" style="opacity:.7"></textarea>
                     <!-- <h3 class="text-dark mb-1">Akshay Singh</h3>
                     <div>478, Nai Sadak</div>
                     <div>Chandni chowk, New delhi, 110006</div>
                     <div>Email: info@tikon.com</div>
                     <div>Phone: +91 9895 398 009</div> -->
                 </div>
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
                         <tr>
                             <td class="left"><input type="text" name="title" class="form-control" style="margin-bottom: 3px" placeholder="Item title">
                             <textarea name="" id="" rows="2" class="form-control"></textarea></td>
                             <td class="center">$</td>
                             <td class="right"><input type="number" name="price" class="form-control" min="0.00" value="0.00" step="0.1" v-model="price"></td>
                             <td class="center"><input type="number" name="quantity" class="form-control" v-model="quantity"></td>
                             <td class="center">$</td>
                             <td class="right">{{ quantity*price }}</td>
                         </tr>
                        <tr>
                             <td class="left"><input type="text" name="title" class="form-control" style="margin-bottom: 3px" placeholder="Item title">
                             <textarea name="" id="" rows="2" class="form-control"></textarea></td>
                             <td class="center">$</td>
                             <td class="right"><input type="number" name="price" class="form-control" min="0.00" value="0.00" step="0.1" v-model="price"></td>
                             <td class="center"><input type="number" name="quantity" class="form-control" v-model="quantity"></td>
                             <td class="center">$</td>
                             <td class="right">{{ quantity*price }}</td>
                         </tr>
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
                                     <strong class="text-dark">IVA 7.7%</strong>
                                 </td>
                                 <td class="right">$2,304,00</td>
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Total</strong> </td>
                                 <td class="right">
                                     <strong class="text-dark">$20,744,00</strong>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
        
     </div>
 </div><!--
    <div>
        <h3 class="text-center">Create Invoice</h3>
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-group col-md-4">
                    <label>Company details</label>
                    <textarea type="text" class="form-control" name="" />
                    </div>
                    <div class="form-group col-md-4">
                    <label>Other details</label>
                    <textarea type="text" class="form-control" name="" />
                    </div>
                </form>
                <form @submit.prevent="addProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="produinvoicect.name"
                        />
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="invoice.detail"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                </form>
            </div>
        </div>
    </div>-->
</template>

<script>
export default {
    data() {
        return {
            price : 0,
            quantity : 0,
            invoice: {},
            invoiceItems: {}
        };
    },
    methods: {
        addInvoice() {
            this.axios
                .post("http://localhost:8000/api/invoices", this.invoice)
                .then(response => this.$router.push({ name: "/" }))
                .catch(err => console.log(err))
                .finally(() => (this.loading = false));
        }
    }
};
</script>
