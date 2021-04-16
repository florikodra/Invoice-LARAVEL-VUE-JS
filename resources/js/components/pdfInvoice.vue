<template>
    <div class="container">
        <div class="card">
            <div class="card-header fill">
                <img src="/pdf-header.jpg" alt="" />
            </div>
            <div class="card-body ml-3 mr-3 text-secondary">
                <div class="row justify-content-between mb-5">
                    <div class="col-lg-4 col-sm-12 col-md-6" style="white-space: pre">
Sede operativa
58996 New York
Tel: 5555 00005896
Mobile: 555 000555
N. IVA: STREET1
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-6 text-lg-right" style="white-space: pre">
                        Saluto
                        Ditta
                        Via
                        65556 City
                    </div>
                </div>

                <h2 class="text-secondary mb-3 font-weight-bold">Fattura</h2>
                <div class="col-lg-4 col-sm-12 col-md-4 backg-c text-white rounded-lg pt-2 pb-2 pl-4 pr-4">
                    <div class="row">
                        <div class="col">
                            Data
                            <h5>{{ this.data }}</h5>
                        </div>
                        <div class="col">
                            Numero fattura
                            <h5>{{ this.numeroFattura }}</h5>
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
                                <tr v-for="index in 20" :key="index">
                                    <td> <b>Mark</b>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </p>
                                    </td>
                                    <td class="text-right"><b class="float-left">$</b>555</td>
                                    <td scope="row" class="text-center">5</td>
                                    <td class="text-right mr-2"><b class="float-left">$</b>555</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-end mr-4">
                    <div
                        class="col-lg-5 col-sm-12 col-md-4 backg-c text-white rounded-lg pt-3 pb-2 pl-2 pr-2 text-lg-center text-sm-center">
                        <div class="row">
                            <div class="col-4">
                                <h4>Totale</h4>
                            </div>
                            <div class="col-2">
                                <h4>$</h4>
                            </div>
                            <div class="col-6">
                                <h4> 2 463.60</h4>
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
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                product: {},
                data: "01.01.2021",
                numeroFattura: "20210101",
            }
        },
        created() {
            /* this.axios
                .get(`http://localhost:8000/api/invoices/${this.$route.params.id}`)
                .then((res) => {
                    this.product = res.data;
                }); */
        },
        methods: {
            updateProduct() {
                /* this.axios
                    .patch(`http://localhost:8000/api/invoices/${this.$route.params.id}`, this.product)
                    .then((res) => {
                        this.$router.push({ name: 'home' });
                    }); */
            }
        }
    }
</script>